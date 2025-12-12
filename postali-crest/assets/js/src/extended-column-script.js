(function(wp) {
	const { unregisterBlockVariation, registerBlockVariation, } = wp.blocks;
	const { addFilter } = wp.hooks;
	const { createHigherOrderComponent } = wp.compose;
	const { Fragment, createElement } = wp.element;
	const { InspectorControls } = wp.blockEditor || wp.editor;
	const { PanelBody, RadioControl } = wp.components;

	addFilter(
		'blocks.registerBlockType',
		'my-plugin/column-alignment-attribute',
		function(settings, name) {
			if (name !== 'core/columns') return settings;

			settings.attributes = Object.assign({}, settings.attributes, {
				columnAlignment: {
					type: 'string',
					default: false
				}
			});

			return settings;
		}
	);

	const addAlignmentOptions = createHigherOrderComponent(function(BlockEdit) {
		return function(props) {
			if (props.name !== 'core/columns') {
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
							RadioControl,
							{
								label: 'Column Alignment',
								options: [
									{ label: 'Space Between', value: 'space-between' },
									{ label: 'Center', value: 'center' },
									{ label: 'Space Around', value: 'space-around' },
									{ label: 'Space Evenly', value: 'space-evenly' },
									{ label: 'Start', value: 'flex-start' },
									{ label: 'End', value: 'flex-end' }
								],
								selected: props.attributes.columnAlignment,
								onChange: function(newValue) {
									props.setAttributes({ columnAlignment: newValue });
								}
							}
						)
					)
				)
			);
		};
	}, 'addAlignmentOptions');

	addFilter(
		'editor.BlockEdit',
		'my-plugin/columns-alignment-options',
		addAlignmentOptions
	);

	addFilter(
		'blocks.getSaveContent.extraProps',
		'my-plugin/columns-add-alignment-class',
		function(extraProps, blockType, attributes) {
			if (blockType.name === 'core/columns' && attributes.columnAlignment) {
				let className = extraProps.className || '';
	
				// Remove existing justify-* classes first
				className = className
					.split(' ')
					.filter(function(cls) {
						return !cls.startsWith('justify-');
					})
					.join(' ');
	
				// Add new justify-* class
				className += ' justify-' + attributes.columnAlignment;
	
				extraProps.className = className.trim();
			}
			return extraProps;
		}
	);

	



	wp.domReady(function() {
		// Unregister the default 50/50 layout
		unregisterBlockVariation('core/columns', 'two-columns-equal');
		// Register a new 50/50 layout with custom widths
		registerBlockVariation('core/columns', {
			name: 'two-columns-equal-custom',
			title: '50 / 50',
			description: 'Two columns; equal split',
			icon: createElement(
				'svg',
				{
					width: 24,
					height: 24,
					viewBox: '0 0 24 24',
					xmlns: 'http://www.w3.org/2000/svg'
				},
				createElement('rect', { x: 3, y: 4, width: 8, height: 16, fill: '#949494' }),
				createElement('rect', { x: 13, y: 4, width: 8, height: 16, fill: '#949494' })
			),
			attributes: {
				align: 'wide',
			},
			innerBlocks: [
				['core/column', { width: '45%' }],
				['core/column', { width: '45%' }]
			],
			isDefault: true,
			scope: ['block'],
		});

		// Unregister the default 25/50/25 layout
		unregisterBlockVariation('core/columns', 'three-columns-wider-center');
		// Register a new 25/50/25 layout with custom widths
		registerBlockVariation('core/columns', {
			name: 'three-columns-wider-center-custom',
			title: '25 / 50 / 25',
			description: 'Three columns; wide center column',
			icon: createElement(
				'svg',
				{
					width: 24,
					height: 24,
					viewBox: '0 0 24 24',
					xmlns: 'http://www.w3.org/2000/svg'
				},
				createElement('rect', { x: 3, y: 4, width: 5, height: 16, fill: '#949494' }),
				createElement('rect', { x: 9, y: 4, width: 8, height: 16, fill: '#949494' }),
				createElement('rect', { x: 18, y: 4, width: 5, height: 16, fill: '#949494' })
			),
			attributes: {
				align: 'wide',
			},
			innerBlocks: [
				['core/column', { width: '23%' }],
				['core/column', { width: '45%' }],
				['core/column', { width: '23%' }]
			],
			isDefault: true,
			scope: ['block'],
		});

		// Unregister the default 33/33/33 layout
		unregisterBlockVariation('core/columns', 'three-columns-equal');
		// Register a new 33/33/33 layout with custom widths
		registerBlockVariation('core/columns', {
			name: 'three-columns-equal-custom',
			title: '33 / 33 / 33',
			description: 'Three columns; equal split',
			icon: createElement(
				'svg',
				{
					width: 24,
					height: 24,
					viewBox: '0 0 24 24',
					xmlns: 'http://www.w3.org/2000/svg'
				},
				createElement('rect', { x: 3, y: 4, width: 6, height: 16, fill: '#949494' }),
				createElement('rect', { x: 10.5, y: 4, width: 6, height: 16, fill: '#949494' }),
				createElement('rect', { x: 18, y: 4, width: 6, height: 16, fill: '#949494' })
			),
			attributes: {
				align: 'wide',
			},
			innerBlocks: [
				['core/column', { width: '30%' }],
				['core/column', { width: '30%' }],
				['core/column', { width: '30%' }]
			],
			isDefault: true,
			scope: ['block'],
		});

		// Unregister the default 66/33 layout
		unregisterBlockVariation('core/columns', 'two-columns-two-thirds-one-third');
		// Register a new 66/33 layout with custom widths
		registerBlockVariation('core/columns', {
			name: 'two-columns-two-thirds-one-third-custom',
			title: '66 / 33',
			description: 'Two columns; two-thirds, one-third split',
			icon: createElement(
				'svg',
				{
					width: 24,
					height: 24,
					viewBox: '0 0 24 24',
					xmlns: 'http://www.w3.org/2000/svg'
				},
				createElement('rect', { x: 17, y: 4, width: 7, height: 16, fill: '#949494' }),
				createElement('rect', { x: 3, y: 4, width: 12, height: 16, fill: '#949494' })
				
			),
			attributes: {
				align: 'wide',
			},
			innerBlocks: [
				['core/column', { width: '63%' }],
				['core/column', { width: '30%' }]
			],
			isDefault: true,
			scope: ['block'],
		});

		// Unregister the default 33/66 layout
		unregisterBlockVariation('core/columns', 'two-columns-one-third-two-thirds');
		// Register a new 33/66 layout with custom widths
		registerBlockVariation('core/columns', {
			name: 'two-columns-one-third-two-thirds-custom',
			title: '33 / 66',
			description: 'Two columns; one-third, two-thirds split',
			icon: createElement(
				'svg',
				{
					width: 24,
					height: 24,
					viewBox: '0 0 24 24',
					xmlns: 'http://www.w3.org/2000/svg'
				},
				createElement('rect', { x: 3, y: 4, width: 7, height: 16, fill: '#949494' }),
				createElement('rect', { x: 12, y: 4, width: 12, height: 16, fill: '#949494' })
			),
			attributes: {
				align: 'wide',
			},
			innerBlocks: [
				['core/column', { width: '30%' }],
				['core/column', { width: '63%' }]
				
			],
			isDefault: true,
			scope: ['block'],
		});
	});
})(window.wp);
