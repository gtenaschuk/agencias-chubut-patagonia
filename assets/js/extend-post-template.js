const { addFilter } = wp.hooks;
const { createHigherOrderComponent } = wp.compose;
const { useSelect } = wp.data;

const withCustomClass = createHigherOrderComponent( ( BlockEdit ) => {
    return ( props ) => {
        if ( props.name === 'core/post-template' ) {
            const postId = useSelect( ( select ) => {
                return select( 'core/editor' ).getCurrentPostId();
            }, [] );

            const categories = useSelect( ( select ) => {
                return select( 'core' ).getEntityRecords( 'taxonomy', 'category', { post: postId } );
            }, [ postId ] );

            let categorySlugs = '';
            if ( categories && categories.length ) {
                categorySlugs = categories.map( cat => cat.slug ).join( ' ' );
            }

            props.attributes.className = ( props.attributes.className || '' ) + ` my-custom-class post-id-${postId} ${categorySlugs}`;
        }

        return <BlockEdit {...props} />;
    };
}, 'withCustomClass' );

addFilter(
    'editor.BlockEdit',
    'dinkuminteractive/extend-post-template',
    withCustomClass
);
