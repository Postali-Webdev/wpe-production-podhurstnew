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
			if (name !== 'core/paragraph') return settings;
			settings.attributes = Object.assign({}, settings.attributes, {
				makeSubtitle: {
					type: 'boolean',
					default: false
				},
				roundedSubtitle: {
					type: 'boolean',
					default: false
				},
				addBox: {
					type: 'boolean',
					default: false
				},
				removeMarginBottom: {
					type: 'boolean',
					default: false
				}
			});

			return settings;
		}
    );
    
    const addHeadingStyle = createHigherOrderComponent(function(BlockEdit) {
		return function(props) {
			if (props.name !== 'core/paragraph') {
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
								checked: !!props.attributes.makeSubtitle,
								onChange: function(newValue) {
									props.setAttributes({ makeSubtitle: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Rounded Subtitle',
								checked: !!props.attributes.roundedSubtitle,
								onChange: function(newValue) {
									props.setAttributes({ roundedSubtitle: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Add Boxed Style',
								checked: !!props.attributes.addBox,
								onChange: function(newValue) {
									props.setAttributes({ addBox: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Remove Bottom Margin',
								checked: !!props.attributes.removeMarginBottom,
								onChange: function(newValue) {
									props.setAttributes({ removeMarginBottom: newValue });
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
            if (blockType.name === 'core/paragraph' && attributes.makeSubtitle) {
				extraProps.className = (extraProps.className || '') + ' paragraph-subtitle';
			}
            if (blockType.name === 'core/paragraph' && attributes.addBox) {
				extraProps.className = (extraProps.className || '') + ' boxed-paragraph';
			}
			if (blockType.name === 'core/paragraph' && attributes.roundedSubtitle) {
				extraProps.className = (extraProps.className || '') + ' paragraph-rounded-subtitle';
			}
			if (blockType.name === 'core/paragraph' && attributes.removeMarginBottom) {
				extraProps.className = (extraProps.className || '') + ' paragraph-remove-bottom-margin';
			}
			return extraProps;
		}
	);

})(window.wp);