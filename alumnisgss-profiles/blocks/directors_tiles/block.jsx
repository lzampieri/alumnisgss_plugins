( function ( blocks, element ) {
    blocks.registerBlockType( 'alumnisgss-theme/block-category-carousel', {
        // apiVersion: 2,
        title: "Carosello categorie",
        name: "alumnisgss-theme/block-category-carousel",
        category: "theme",
        attributes: {
            categoryId: {
                type: 'number',
                default: 0
            }
        },
        icon: "menu",
        edit: function ( props ) {
            const { cats } = wp.data.useSelect( ( select ) => {
                return { cats: select('core').getEntityRecords( 'taxonomy', 'category' ) }
             } )

            if( cats == null ) {
                return (
                    <div className="two-cols-flex">
                        Loading...
                    </div>
                )
            }

            var options = cats.map( (m) => {
                return { label: m['name'], value: m['id'] }
            });
            options.unshift(
                { label: "Nessuno", value: 0 }
            )

            return (
                <div className="two-cols-flex">
                    <wp.components.SelectControl
                        label="Categoria:"
                        value={ props.attributes.categoryId }
                        options = { options }
                        onChange={ ( newCatId ) => props.setAttributes( { categoryId: parseInt( newCatId ) } ) }
                        />
                    <wp.serverSideRender
                        block="alumnisgss-theme/block-category-carousel"
                        attributes={ { categoryId: props.attributes.categoryId } } />
                </div>
            )
        },
        save ( props ) { return null }
    } );
} )( window.wp.blocks, window.wp.element );