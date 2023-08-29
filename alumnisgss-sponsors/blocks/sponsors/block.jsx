(function (blocks, element) {
    blocks.registerBlockType('asgsss/block-sponsors', {
        // apiVersion: 2,
        title: "Sponsor",
        name: "asgsss/block-sponsors",
        category: "plugin",
        icon: "admin-multisite",
        edit: function (props) {

            const addSponsor = () => {
                props.setAttributes({
                    list: [...props.attributes.list, {
                        imageId: null,
                        imageSrc: '',
                        link: ''
                    }]
                });
            }
            const removeSponsor = (index) => {
                props.attributes.list.splice(index, 1);
                props.setAttributes({ list: props.attributes.list.slice() });
            }

            const setMedia = (index, newMedia) => {
                newList = props.attributes.list.slice();
                newList[index].imageId = newMedia.id;
                newList[index].imageSrc = newMedia.url;
                props.setAttributes({ list: newList });
            }

            const setLink = (index, newLink) => {
                newList = props.attributes.list.slice();
                newList[index].link = newLink;
                props.setAttributes({ list: newList });
            }

            return (
                <React.Fragment>
                    {props.attributes.list && props.attributes.list.map((s, index) =>
                        <div className="asgsss-item">
                            <div>
                                <wp.components.Button icon="trash" onClick={() => removeSponsor(index)} />
                            </div>
                            <wp.blockEditor.MediaUpload
                                allowedTypes={['image']}
                                value={s.imageId}
                                render={({ open }) => (
                                    <a
                                        className="button no-underline"
                                        onClick={open}
                                    >
                                        {s.imageId == 0 ? "Scegli" : "Cambia"} immagine
                                    </a>
                                )}
                                onSelect={(media) => setMedia(index, media)}
                            />
                            <img src={s.imageSrc} className="asgsss-thumbnail" />
                            <input
                                value={s.link}
                                onChange={(e) => setLink(index, e.target.value)}
                                className="asgsss-input"
                                placeholder="Link..."
                            />
                        </div>
                    )}
                    <wp.components.Button icon="plus" onClick={addSponsor} />
                </React.Fragment>
            )
        },
        save(props) {
            return (
                <div className="asgsss-gallery">
                    {props.attributes.list && props.attributes.list.map((s, index) =>
                        <a href={s.link}>
                            <img src={s.imageSrc} className="asgsss-image" />
                        </a>
                    )}
                </div>
            )
        }
    });
})(window.wp.blocks, window.wp.element);