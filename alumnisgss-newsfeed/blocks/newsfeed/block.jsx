( function ( blocks, element ) {
    blocks.registerBlockType( 'asgssn/block-newsfeed', {
        // apiVersion: 2,
        title: "Newsfeed: articoli in evidenza",
        name: "asgssn/block-newsfeed",
        category: "plugin",
        icon: "welcome-widgets-menus",
        edit: function ( props ) {
            return (
                <React.Fragment>
                    <wp.serverSideRender block="asgssn/block-newsfeed" />
                </React.Fragment>
            )
        },
        save ( props ) { return null }
    } );
} )( window.wp.blocks, window.wp.element );