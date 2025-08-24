BX.namespace('Otus.Modal.Dialog');

BX.Otus.Modal.Dialog = {
    popupId: null,
    caption: null,
    content: null,
    htmlContent: null,
    actionYes: null,
    actionNo: null,
    popup: {},
    init: function (data) {
        this.popupId = data.popupId;
        this.caption = data.caption;
        this.content = data.content;
        this.htmlContent = data.htmlContent;
        this.actionYes = data.actionYes;
        this.actionNo = data.actionNo;
    },
    createPopup: function () {
        let contentHtmlBlock = BX.create('div', {
            props: {
                className: 'otus-popup__content-default'
            },
            html: this.content,
        });

        let content = null !== this.content ?
            contentHtmlBlock.innerHTML :
            this.htmlContent;

        let actionYes, actionNo;
        if ('close' === this.actionYes) {
            actionYes = () => {
                alert('Вы согласились! Закройте окно!');
                this.closePopup();
            }
        } else {
            actionYes = () => {
                this.closePopup();
            }
        }

        if ('close' === this.actionNo) {
            actionNo = () => {
                alert('Вы отказались! Закройте окно!');
                this.closePopup();
            }
        } else {
            actionNo = () => {
                this.closePopup();
            }
        }

        this.popup = new BX.PopupWindow(this.popupId, window.body, {
            zIndex: 1,
            offsetLeft: 0,
            offsetTop: 0,
            draggable: {restrict: false},
            overlay: {backgroundColor: 'black', opacity: '80' },
            titleBar: {
                content: this.caption,
            },
            buttons: [
                new BX.PopupWindowButton({
                    text: "Да",
                    className: "popup-window-button-accept",
                    events: {
                        click: actionYes,
                    }
                }),
                new BX.PopupWindowButton({
                    text: "Нет",
                    className: "webform-button-link-cancel",
                    events: {
                        click: actionNo,
                    }
                }),
            ],
        });
        this.popup.setContent(content);
        this.popup.setTitleBar(this.caption);
    },
    openPopup: function () {
        this.popup.show();
    },
    closePopup: function () {
        this.popup.close();
    }
};
