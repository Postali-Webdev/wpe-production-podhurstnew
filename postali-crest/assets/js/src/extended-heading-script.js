(function (wp) {
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Fragment, createElement } = wp.element;
	const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, ToggleControl } = wp.components;
    
    addFilter(
		'blocks.registerBlockType',
		'my-plugin/heading-style-attribute',
		function(settings, name) {
			if (name !== 'core/heading') return settings;
			settings.attributes = Object.assign({}, settings.attributes, {
				addIcon: {
					type: 'boolean',
					default: false
				},
				leftOffset: {
					type: 'boolean',
					default: false
				}
			});

			return settings;
		}
    );
    
    const addHeadingStyle = createHigherOrderComponent(function(BlockEdit) {
		return function(props) {
			if (props.name !== 'core/heading') {
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
						{ title: 'Additional Styles', initialOpen: true },
                        createElement(
							ToggleControl,
							{
								label: 'Add Dashed Icon',
								checked: !!props.attributes.addIcon,
								onChange: function(newValue) {
									props.setAttributes({ addIcon: newValue });
								}
							}
						),
                        createElement(
							ToggleControl,
							{
								label: 'Add Left Spacing',
								checked: !!props.attributes.leftOffset,
								onChange: function(newValue) {
									props.setAttributes({ leftOffset: newValue });
								}
							}
						),
					)
				)
			);
		};
	}, 'addHeadingStyle');

	addFilter(
		'editor.BlockEdit',
		'my-plugin/heading-style-attribute',
		addHeadingStyle
	);

	addFilter(
		'blocks.getSaveContent.extraProps',
		'my-plugin/heading-style-attribute',
		function(extraProps, blockType, attributes) {
            if (blockType.name === 'core/heading' && attributes.addIcon) {
				extraProps.className = (extraProps.className || '') + ' heading-with-icon';
			}
            if (blockType.name === 'core/heading' && attributes.leftOffset) {
				extraProps.className = (extraProps.className || '') + ' heading-left-offset';
			}
			return extraProps;
		}
	);

})(window.wp);