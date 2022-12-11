( function ( blocks, element ) {
    blocks.registerBlockType( 'asgssp/block-directors-tiles', {
        // apiVersion: 2,
        title: "Consiglio di amministrazione",
        name: "asgssp/block-directors-tiles",
        category: "plugin",
        icon: "businessperson",
        edit: function ( props ) {
            const { directors } = wp.data.useSelect( ( select ) => {
                return { directors: select('core').getEntityRecords( 'postType', 'asgssp_director' ) }
             } )

            if( directors == null ) {
                return (
                    <div className="two-cols-flex">
                        Loading...
                    </div>
                )
            }

            return (
                <React.Fragment>
                    <wp.serverSideRender block="asgssp/block-directors-tiles" />
                </React.Fragment>
            )
        },
        save ( props ) { return null }
    } );
} )( window.wp.blocks, window.wp.element );