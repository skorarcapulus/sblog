/**
 * Gutenberg Block Editor Enhancements
 * This file is loaded only in the WordPress admin block editor
 */

wp.domReady(() => {
    console.log('Skorar Theme: Block editor loaded');
    
    // Enable wide/full alignment for heading blocks
    wp.hooks.addFilter(
        'blocks.registerBlockType',
        'skorar-theme/enable-alignment',
        (settings, name) => {
            // Enable alignment for heading blocks
            if (name === 'core/heading') {
                settings.supports = {
                    ...settings.supports,
                    align: ['wide', 'full'],
                    alignWide: true,
                };
            }
            
            return settings;
        }
    );
    
    // Add custom button style variation
    wp.blocks.registerBlockStyle('core/button', {
        name: 'skorar-outline',
        label: 'Outline',
        style: {
            border: '2px solid var(--wp--preset--color--primary)',
            backgroundColor: 'transparent',
            color: 'var(--wp--preset--color--primary)'
        }
    });
});