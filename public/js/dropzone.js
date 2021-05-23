window.onload = () => {

    const url = 'http://localhost/laravel/sari_laravel/public/';

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const reportId = document.querySelector('#folio').value;

    let myDropzone = new Dropzone("#resources", {
      url: url+'save-resource',
      paramName: "resource", // The name that will be used to transfer the file
      acceptedFiles: 'image/*,video/*',
      maxFilesize: 100, // MB
      dictInvalidFileType: "Archivo inválido, selecciona una imagen o video.",
      dictRemoveFile: "Borrar archivo",
      // dictRemoveFileConfirmation: "¿Seguro que quieres borrar el archivo?",
      addRemoveLinks: true,
      previewsContainer: "#previews",
      clickable: ".fileinput-button",
      accept: function(file, done) {
        if (file.name == "justinbieber.jpg") {
          done("Naha, you don't.");
        }
        else { done(); }
      }
    });

    myDropzone.on("sending", function(file, xhr, formData) {
      // Will send the filesize along with the file as POST data.
      formData.append("_token", csrfToken);
      formData.append("report_id", reportId);
    });

    // let mockFile = { name: "Filename", size: 30000000 };
    // myDropzone.displayExistingFile(mockFile, url+'images/user.png');

    myDropzone.on("addedfile", file => {
      console.log("A file has been added");
    });

    const getResourcesByReportId = async(reportId) => {
      try {
        const resp = await fetch(url+'get-resources/report/'+ reportId);
        const { resources } = await resp.json();
        return await resources;
        

      } catch(error) {
          // Manejo del error
          console.error(error);
          return null;
      }
    }

    const resources = getResourcesByReportId(reportId);
    resources.then(data => {
      data.forEach( image => {

        const formato = image.url.indexOf('.mp4');
        let mockFile = {};
        if(formato === -1 ) {
          mockFile = { name: "Imagen" };
        } else {
          mockFile = { name: "Video" };
        }
        myDropzone.displayExistingFile(mockFile, url+'get-image/'+image.url);
      });
    })
}
