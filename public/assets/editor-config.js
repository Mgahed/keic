    //
    // if(! uploadUrl)
    // {
    //     uploadUrl = 'admin/content/media-library';
    // }
    // $('.summernote').summernote({
    //     height: 150,
    //
    //     callbacks: {
    //         onImageUpload: function(files) {
    //             sendFile(files, $(this));
    //         }
    //     }
    //
    // });
    // var sendFile = function(file, editor)
    // {
    //     data = new FormData();
    //     console.log(file[0]);
    //     data.append("file", file[0]);
    //     data.append("_token", csrfToken);
    //     $.ajax({
    //         data: data,
    //         type: "POST",
    //         url: uploadUrl,
    //         cache: false,
    //         contentType: false,
    //         processData: false,
    //         success: function(url) {
    //             editor.summernote('insertImage', url);
    //             // editor.insertImage(url);
    //         }
    //     });
    // }