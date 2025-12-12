(function (wp) {
	
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Fragment, createElement } = wp.element;
	const { InspectorControls } = wp.blockEditor || wp.editor;
	const { PanelBody, ToggleControl } = wp.components;
	const { unregisterBlockVariation } = wp.blocks;

	// 1. Add a new attribute to core/group
	addFilter(
		'blocks.registerBlockType',
		'my-plugin/group-full-width-attribute',
		function(settings, name) {
			if (name !== 'core/group') return settings;

			settings.attributes = Object.assign({}, settings.attributes, {
				fullWidth: {
					type: 'boolean',
					default: false
				},
				contentWrapper: {
					type: 'boolean',
					default: false
				},
				darkBlueBg: {
					type: 'boolean',
					default: false
				},
				lightGreyBg: {
					type: 'boolean',
					default: false
				},
				removePadding: {
					type: 'boolean',
					default: false
				},
				clipBottomTriangle: {
					type: 'boolean',
					default: false
				},
				clipSlantHL: {
					type: 'boolean',
					default: false
				},
				clipSlantLH: {
					type: 'boolean',
					default: false
				},
				clipTopSlantHl: {
					type: 'boolean',
					default: false
				},
				clipTopSlantLh: {
					type: 'boolean',
					default: false
				},
				enableAccordion: {
					type: 'boolean',
					default: false
				}
			});

			return settings;
		}
	);
    

	// 2. Add a toggle to InspectorControls
	const addLayoutSettings = createHigherOrderComponent(function(BlockEdit) {
		return function(props) {
			if (props.name !== 'core/group') {
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
						{ title: 'Clip Path', initialOpen: true },
						createElement(
							ToggleControl,
							{
								label: 'Clip Bottom Triangle',
								checked: !!props.attributes.clipBottomTriangle,
								onChange: function(newValue) {
									props.setAttributes({ clipBottomTriangle: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Clip Bottom Slant High to Low',
								checked: !!props.attributes.clipSlantHL,
								onChange: function(newValue) {
									props.setAttributes({ clipSlantHL: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Clip Bottom Slant Low to High',
								checked: !!props.attributes.clipSlantLH,
								onChange: function(newValue) {
									props.setAttributes({ clipSlantLH: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Clip Top Slant High to Low',
								checked: !!props.attributes.clipTopSlantHl,
								onChange: function(newValue) {
									props.setAttributes({ clipTopSlantHl: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Clip Top Slant Low to High',
								checked: !!props.attributes.clipTopSlantLh,
								onChange: function(newValue) {
									props.setAttributes({ clipTopSlantLh: newValue });
								}
							}
						),
					),
					createElement(
						PanelBody,
						{ title: 'Layout Settings', initialOpen: true },
						createElement(
							ToggleControl,
							{
								label: 'Full Width',
								checked: !!props.attributes.fullWidth,
								onChange: function(newValue) {
									props.setAttributes({ fullWidth: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Content Wrapper',
								checked: !!props.attributes.contentWrapper,
								onChange: function(newValue) {
									props.setAttributes({ contentWrapper: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Remove Padding',
								checked: !!props.attributes.removePadding,
								onChange: function(newValue) {
									props.setAttributes({ removePadding: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Enable Dark Blue Background',
								checked: !!props.attributes.darkBlueBg,
								onChange: function(newValue) {
									props.setAttributes({ darkBlueBg: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Enable Light Grey Background',
								checked: !!props.attributes.lightGreyBg,
								onChange: function(newValue) {
									props.setAttributes({ lightGreyBg: newValue });
								}
							}
						),
						createElement(
							ToggleControl,
							{
								label: 'Enable Accordion',
								checked: !!props.attributes.enableAccordion,
								onChange: function(newValue) {
									props.setAttributes({ enableAccordion: newValue });
								}
							}
						)
					)
				)
			);
		};
	}, 'addLayoutSettings');

	addFilter(
		'editor.BlockEdit',
		'my-plugin/group-full-width-toggle',
		addLayoutSettings
	);

	// 3. Add the full-width class to saved markup
	addFilter(
		'blocks.getSaveContent.extraProps',
		'my-plugin/group-add-class',
		function(extraProps, blockType, attributes) {
			if (blockType.name === 'core/group' && attributes.fullWidth) {
				extraProps.className = (extraProps.className || '') + ' full-width';
			}
			if (blockType.name === 'core/group' && attributes.contentWrapper) {
				extraProps.className = (extraProps.className || '') + ' content-wrapper';
			}
			if (blockType.name === 'core/group' && attributes.removePadding) {
				extraProps.className = (extraProps.className || '') + ' remove-padding';
			}
			if (blockType.name === 'core/group' && attributes.darkBlueBg) {
				extraProps.className = (extraProps.className || '') + ' dark-blue-bg';
			}
			if (blockType.name === 'core/group' && attributes.lightGreyBg) {
				extraProps.className = (extraProps.className || '') + ' light-grey-bg';
			}
			if (blockType.name === 'core/group' && attributes.clipBottomTriangle) {
				extraProps.className = (extraProps.className || '') + ' clip-bottom-triangle';
			}
			if (blockType.name === 'core/group' && attributes.clipSlantHL) {
				extraProps.className = (extraProps.className || '') + ' clip-slant-hl';
			}
			if (blockType.name === 'core/group' && attributes.clipSlantLH) {
				extraProps.className = (extraProps.className || '') + ' clip-slant-lh';
			}
			if (blockType.name === 'core/group' && attributes.clipTopSlantHl) {
				extraProps.className = (extraProps.className || '') + ' clip-top-slant-hl';
			}
			if (blockType.name === 'core/group' && attributes.clipTopSlantLh) {
				extraProps.className = (extraProps.className || '') + ' clip-top-slant-lh';
			}
			if (blockType.name === 'core/group' && attributes.enableAccordion) {
				extraProps.className = (extraProps.className || '') + ' enable-accordion';
			}
			return extraProps;
		}
	);
		
	wp.domReady(function () {
		unregisterBlockVariation('core/group', 'group-stack');
		unregisterBlockVariation('core/group', 'group-row');
		unregisterBlockVariation('core/group', 'group-grid');
	});

})(window.wp);
