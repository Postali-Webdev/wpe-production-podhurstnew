(function(wp) {
    const { addFilter } = wp.hooks;
    const { createHigherOrderComponent } = wp.compose;
    const { Fragment, createElement } = wp.element;
    const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, ToggleControl } = wp.components;
    const { useSelect } = wp.data;

    addFilter(
        'blocks.registerBlockType',
        'my-plugin/column-alignment-attribute',
        function(settings, name) {
            if (name !== 'core/column') return settings;

            settings.attributes = Object.assign({}, settings.attributes, {
                leftPadding: {
                    type: 'boolean',
                    default: false
                },
                rightPadding: {
                    type: 'boolean',
                    default: false
                }
            });

            return settings;
        }
    );

    const addPaddingOptions = createHigherOrderComponent((BlockEdit) => {
        return (props) => {
            if (props.name !== 'core/column') {
                return createElement(BlockEdit, props);
            }

            // Check if this column's parent is core/columns
            const parentIsColumns = useSelect((select) => {
                const { getBlockRootClientId, getBlockName } = select('core/block-editor');
                const parentId = getBlockRootClientId(props.clientId);
                return parentId && getBlockName(parentId) === 'core/columns';
            }, [props.clientId]);

            if (!parentIsColumns) {
                return createElement(BlockEdit, props);
            }

            return createElement(
                Fragment,
                {},
                createElement(BlockEdit, props),
                createElement(
                    InspectorControls,
                    {},
                    createElement(
                        PanelBody,
                        { title: 'Layout Settings', initialOpen: true },
                        createElement(
                            ToggleControl,
                            {
                                label: 'Add Left Spacing',
                                checked: !!props.attributes.leftPadding,
                                onChange: function(newValue) {
                                    props.setAttributes({ leftPadding: newValue });
                                }
                            }
                        ),
                        createElement(
                            ToggleControl,
                            {
                                label: 'Add Right Spacing',
                                checked: !!props.attributes.rightPadding,
                                onChange: function(newValue) {
                                    props.setAttributes({ rightPadding: newValue });
                                }
                            }
                        )
                    )
                )
            );
        };
    }, 'addPaddingOptions');

    addFilter(
        'editor.BlockEdit',
        'my-plugin/columns-alignment-options',
        addPaddingOptions
    );

    addFilter(
        'blocks.getSaveContent.extraProps',
        'my-plugin/heading-style-attribute',
        function(extraProps, blockType, attributes) {
            if (blockType.name === 'core/column' && attributes.leftPadding) {
                extraProps.className = (extraProps.className || '') + ' column-left-padding';
            }
            if (blockType.name === 'core/column' && attributes.rightPadding) {
                extraProps.className = (extraProps.className || '') + ' column-right-padding';
            }
            return extraProps;
        }
    );

})(window.wp);