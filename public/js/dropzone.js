function create_dropzone(element_id, init = null, acceptedFiles = null, name = 'file'){
    if(acceptedFiles == null){
        acceptedFiles = ".jpeg,.jpg,.png"
    }
    if(init == null || init == ''){
        initfun = function(){}
    }else{
        initfun = function(){
            thisDropzone = this;
            var mockFile = { name: `${element_id}`, size: 100000 };
            thisDropzone.displayExistingFile(mockFile, `data:image/png;base64,${init}`);
            $(`#${element_id} .dz-filename`).on('click',function(){
                $('#image-modal #modal-body').html(`<img style="width:100%" src="data:image/png;base64,${init}" >`)
                $('#image-modal').modal('show')
            })
            
        }
    }
    var myDropzone = $(`#${element_id}`).dropzone({
        // addRemoveLinks: true,
        acceptedFiles: acceptedFiles,
        init: initfun,
        paramName: name,
        success: function (file, response) {
            console.log(response);
        },
    });

    myDropzone.on("sending", function(file, xhr, formData) {
        // Will send the filesize along with the file as POST data.
        formData.append("filesize", file.size);
        formData.append("fileName", `${element_id}`);
   });
}