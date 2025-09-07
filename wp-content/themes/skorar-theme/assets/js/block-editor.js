/**
 * Gutenberg Block Editor Enhancements
 * This file is loaded only in the WordPress admin block editor
 */

wp.domReady(() => {
    console.log('Skorar Theme: Block editor loaded');
    
    // You can add custom block editor functionality here
    // For example: disable certain blocks, add custom styles, etc.
    
    // Example: Add a custom style variation to the button block
    wp.blocks.registerBlockStyle('core/button', {
        name: 'skorar-outline',
        label: 'Outline',
        style: {
            border: '2px solid var(--wp--preset--color--primary)',
            backgroundColor: 'transparent',
            color: 'var(--wp--preset--color--primary)'
        }
    });
    
    // Example: Unregister a block style you don't want
    // wp.blocks.unregisterBlockStyle('core/button', 'outline');
});