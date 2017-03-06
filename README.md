# Base64ImgUpload
PHP - Jquery Upload base64 image in Mysql

# MYSQL
 use upload_db database
 
### Create database and tables
```sql

CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` longtext NOT NULL,
  `ext` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
```

# Usage 
script.js

```js

//function to check file size before uploading.
function beforeSubmit() {

    $('#output').html("<b class='text-center'><img src='images/ajax-loader.gif' alt='' /> In progress...</b>");


    //check whether browser fully supports all File API
    if (window.File && window.FileReader && window.FileList && window.Blob) {

        if (!$('#imageInput').val()) //check empty input filed
        {
            $("#output").html("Select image !!!!!!");
            return false
        }

        var fsize = $('#imageInput')[0].files[0].size; //get file size
        var ftype = $('#imageInput')[0].files[0].type; // get file type

        //allow only valid image file types
        switch (ftype) {
            case 'image/png': case 'image/gif': case 'image/jpeg': case 'image/pjpeg':
            break;
            default:
                $("#output").html("<b>" + ftype + "</b>  Unsupported file type!!");
                return false
        }

        //Allowed file size is less than 1 MB (1048576)
        if (fsize > 1048576) {
            $("#output").html("<b>" + bytesToSize(fsize) + "</b> Too big Image file! <br />Please reduce the size of your photo using an image editor.");
            return false
        }


        encodeImageFileAsURL(ftype);
    }
    else {
        //Output error to older unsupported browsers that doesn't support HTML5 File API
        $("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!!");
        return false;
    }
}



function encodeImageFileAsURL(ftype){



    var fileUpload = $('#imageInput').get(0);
    var file = fileUpload.files;


    // alert(file);
    if (file.length > 0)
    {
        var fileToLoad = file[0];

        var fileReader = new FileReader();

        fileReader.onload = function(fileLoadedEvent) {
            var srcData = fileLoadedEvent.target.result; // <--- data: base64

            // alert(srcData);
            upload(srcData,ftype);
        };
        fileReader.readAsDataURL(fileToLoad);
    }
}

function upload(base64Image,ftype){


    // AJAX Code To Submit Form.
    $.ajax({
        type: "POST",
        url: "Process.php",
        data: {"img": base64Image, "ex": ftype},
        cache: false,
        success: function(result){

            if(result){
                var image = $("<img>", {
                    "src": result,
                    "width": "250px",
                    "height": "250px"
                });
                $("#output").empty();
                $("#output").append(image);
            }else{
                $("#output").empty();
                $("#output").html("Error to insert database!!");
            }

        },
        error: function (r) {
            $("#output").empty();
            $("#output").html("Error to upload image!!");

        }
    });

}
```
# Output

![output](https://github.com/anicetkeric/Base64ImgUpload/blob/master/output.PNG)
