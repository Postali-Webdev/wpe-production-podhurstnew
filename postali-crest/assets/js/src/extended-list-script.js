(function (wp) {
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Fragment, createElement } = wp.element;
	const { InspectorControls } = wp.blockEditor || wp.editor;
    const { PanelBody, ToggleControl } = wp.components;
    
    addFilter(
		'blocks.registerBlockType',
		'my-plugin/list-style-attribute',
		function(settings, name) {
			if (name !== 'core/list') return settings;
			settings.attributes = Object.assign({}, settings.attributes, {
				anchorList: {
					type: 'boolean',
					default: false
				},
			});

			return settings;
		}
    );
    
    const addHeadingStyle = createHigherOrderComponent(function(BlockEdit) {
		return function(props) {
			if (props.name !== 'core/list') {
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
								label: 'Subtitle',
								checked: !!props.attributes.anchorList,
								onChange: function(newValue) {
									props.setAttributes({ anchorList: newValue });
								}
							}
						)
					)
				)
			);
		};
	}, 'addHeadingStyle');

	addFilter(
		'editor.BlockEdit',
		'my-plugin/list-style-attribute',
		addHeadingStyle
	);

	addFilter(
		'blocks.getSaveContent.extraProps',
		'my-plugin/list-style-attribute',
		function(extraProps, blockType, attributes) {
            if (blockType.name === 'core/list' && attributes.anchorList) {
				extraProps.className = (extraProps.className || '') + ' list-anchor-links';
			}
			return extraProps;
		}
	);

})(window.wp);