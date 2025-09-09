/**
 * Content Block - Custom block with header, subheader, and paragraph
 */

const { registerBlockType } = wp.blocks;
const { RichText, BlockControls, InspectorControls, AlignmentToolbar } = wp.blockEditor;
const { ToolbarGroup, PanelBody, SelectControl } = wp.components;
const { __ } = wp.i18n;
const { Fragment } = wp.element;

registerBlockType('skorar-theme/content-block', {
    title: __('Content Block', 'skorar-theme'),
    icon: 'editor-alignleft',
    category: 'common',
    description: __('A content block with header, subheader and paragraph text.', 'skorar-theme'),
    keywords: [__('content'), __('text'), __('header')],
    
    supports: {
        align: ['wide', 'full'],
        alignWide: true,
    },
    
    attributes: {
        header: {
            type: 'string',
            source: 'html',
            selector: '.content-block__header',
            default: '',
        },
        subheader: {
            type: 'string',
            source: 'html',
            selector: '.content-block__subheader',
            default: '',
        },
        content: {
            type: 'string',
            source: 'html',
            selector: '.content-block__content',
            default: '',
        },
        headerLevel: {
            type: 'number',
            default: 2,
        },
        textAlignment: {
            type: 'string',
            default: 'left',
        },
    },

    edit: function(props) {
        const { attributes, setAttributes, className } = props;
        const { header, subheader, content, headerLevel, textAlignment } = attributes;

        const HeaderTag = `h${headerLevel}`;

        return wp.element.createElement(
            Fragment,
            {},
            wp.element.createElement(
                BlockControls,
                {},
                wp.element.createElement(
                    ToolbarGroup,
                    {},
                    wp.element.createElement(AlignmentToolbar, {
                        value: textAlignment,
                        onChange: (value) => setAttributes({ textAlignment: value })
                    })
                )
            ),
            wp.element.createElement(
                InspectorControls,
                {},
                wp.element.createElement(
                    PanelBody,
                    { title: __('Header Settings', 'skorar-theme') },
                    wp.element.createElement(SelectControl, {
                        label: __('Header Level', 'skorar-theme'),
                        value: headerLevel,
                        options: [
                            { label: 'H1', value: 1 },
                            { label: 'H2', value: 2 },
                            { label: 'H3', value: 3 },
                            { label: 'H4', value: 4 },
                            { label: 'H5', value: 5 },
                            { label: 'H6', value: 6 },
                        ],
                        onChange: (value) => setAttributes({ headerLevel: parseInt(value) })
                    })
                )
            ),
            wp.element.createElement(
                'div',
                { 
                    className: `${className} content-block`,
                    style: { textAlign: textAlignment }
                },
                wp.element.createElement(RichText, {
                    tagName: 'p',
                    className: 'content-block__subheader',
                    placeholder: __('Add subheader...', 'skorar-theme'),
                    value: subheader,
                    onChange: (value) => setAttributes({ subheader: value }),
                    style: { 
                        fontSize: '1.2rem',
                        fontWeight: '600',
                        color: '#F9004D',
                        marginBottom: '0.5rem'
                    }
                }),
                wp.element.createElement(RichText, {
                    tagName: HeaderTag,
                    className: 'content-block__header',
                    placeholder: __('Add header...', 'skorar-theme'),
                    value: header,
                    onChange: (value) => setAttributes({ header: value }),
                    style: { 
                        fontSize: headerLevel === 1 ? '2.5rem' : headerLevel === 2 ? '2rem' : '1.5rem',
                        color: '#C4CFDE'
                    }
                }),
                wp.element.createElement(RichText, {
                    tagName: 'div',
                    className: 'content-block__content',
                    placeholder: __('Add your content...', 'skorar-theme'),
                    value: content,
                    onChange: (value) => setAttributes({ content: value }),
                    multiline: 'p'
                })
            )
        );
    },

    save: function(props) {
        const { attributes } = props;
        const { header, subheader, content, headerLevel, textAlignment } = attributes;

        const HeaderTag = `h${headerLevel}`;

        return wp.element.createElement(
            'div',
            { 
                className: 'content-block',
                style: { textAlign: textAlignment }
            },
            subheader && wp.element.createElement(RichText.Content, {
                tagName: 'p',
                className: 'content-block__subheader',
                value: subheader
            }),
            header && wp.element.createElement(RichText.Content, {
                tagName: HeaderTag,
                className: 'content-block__header',
                value: header
            }),
            content && wp.element.createElement(RichText.Content, {
                tagName: 'div',
                className: 'content-block__content',
                value: content
            })
        );
    },
});