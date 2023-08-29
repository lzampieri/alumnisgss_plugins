/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(1);


/***/ }),
/* 1 */
/***/ (function(module, exports) {

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
            };
            const removeSponsor = index => {
                props.attributes.list.splice(index, 1);
                props.setAttributes({ list: props.attributes.list.slice() });
            };

            const setMedia = (index, newMedia) => {
                newList = props.attributes.list.slice();
                newList[index].imageId = newMedia.id;
                newList[index].imageSrc = newMedia.url;
                props.setAttributes({ list: newList });
            };

            const setLink = (index, newLink) => {
                newList = props.attributes.list.slice();
                newList[index].link = newLink;
                props.setAttributes({ list: newList });
            };

            return wp.element.createElement(
                React.Fragment,
                null,
                props.attributes.list && props.attributes.list.map((s, index) => wp.element.createElement(
                    "div",
                    { className: "asgsss-item" },
                    wp.element.createElement(
                        "div",
                        null,
                        wp.element.createElement(wp.components.Button, { icon: "trash", onClick: () => removeSponsor(index) })
                    ),
                    wp.element.createElement(wp.blockEditor.MediaUpload, {
                        allowedTypes: ['image'],
                        value: s.imageId,
                        render: ({ open }) => wp.element.createElement(
                            "a",
                            {
                                className: "button no-underline",
                                onClick: open
                            },
                            s.imageId == 0 ? "Scegli" : "Cambia",
                            " immagine"
                        ),
                        onSelect: media => setMedia(index, media)
                    }),
                    wp.element.createElement("img", { src: s.imageSrc, className: "asgsss-thumbnail" }),
                    wp.element.createElement("input", {
                        value: s.link,
                        onChange: e => setLink(index, e.target.value),
                        className: "asgsss-input",
                        placeholder: "Link..."
                    })
                )),
                wp.element.createElement(wp.components.Button, { icon: "plus", onClick: addSponsor })
            );
        },
        save(props) {
            return wp.element.createElement(
                "div",
                { className: "asgsss-gallery" },
                props.attributes.list && props.attributes.list.map((s, index) => wp.element.createElement(
                    "a",
                    { href: s.link },
                    wp.element.createElement("img", { src: s.imageSrc, className: "asgsss-image" })
                ))
            );
        }
    });
})(window.wp.blocks, window.wp.element);

/***/ })
/******/ ]);