/**
 * imagefield
 *
 * @copyright Copyright © 2017 Staempfli AG. All rights reserved.
 * @author    juan.alonso@gmail.com
 */

/*jshint jquery:true*/
define([
    'jquery',
    'jquery/ui'
], function ($) {
    'use strict';

    $.widget('staempfli_widgetextrafields.imagefield', {
        options: {
            imagePathInputSelector: null,
            imagePreviewDivSelector: null,
            imageDeleteButtonSelector: null,
            mediaUrl: null,
            placeholderUrl: null
        },

        _create: function() {
            this.getImagePathInput().on('change', $.proxy(this.updateImage, this));
            this.getDeleteButton().on('click', $.proxy(this.deleteImage, this));
        },

        getImagePathInput: function() {
            return this.element.find(this.options.imagePathInputSelector).first();
        },

        getDeleteButton: function() {
            return this.element.find(this.options.imageDeleteButtonSelector).first();
        },

        getPreviewImageDiv: function() {
            return this.element.find(this.options.imagePreviewDivSelector).first();
        },

        getLinkElement: function() {
            return this.getPreviewImageDiv().find('a').first();
        },
        getSpanElement: function() {
            return this.getPreviewImageDiv().find('span').first();
        },

        getImgElement: function() {
            return this.getPreviewImageDiv().find('img').first();
        },

        updateImage: function() {
            var newImagePath = this.getImagePathInput().val();
            if (newImagePath.indexOf('__directive') !== -1) {
                try {
                    var data = /__directive\/([^,\/]+)/.exec(newImagePath)[1];
                    var link = '/media/' + Base64.idDecode(data).replace(/.*"([^"]+)".*/, '$1');
                    this.getImagePathInput().val(link);
                } catch (error) {
                    console.log(error);
                }
                var newImageUrl = link;
                this.getSpanElement().html(newImageUrl);
                this.getLinkElement().attr('href', newImageUrl);
                if (newImageUrl.indexOf('.pdf') > 0){
                    newImageUrl = this.options.placeholderUrl;
                }
                this.getImgElement().attr('src', newImageUrl);
                this.getPreviewImageDiv().show();
            }
        },
        deleteImage: function() {
            this.getImagePathInput().val('');
            this.getLinkElement().attr('href', '');
            this.getImgElement().attr('src', '');
            this.getPreviewImageDiv().hide();
        }

    });

    return $.staempfli_widgetextrafields.imagefield;
});
