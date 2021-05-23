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
      // addRemoveLinks: true,
      previewsContainer: "#previews",
      clickable: ".fileinput-button",
      // accept: function(file, done) {
      //   if (file.name == "justinbieber.jpg") {
      //     done("Naha, you don't.");
      //   }
      //   else { done(); }
      // }
    });

    myDropzone.on("sending", function(file, xhr, formData) {
      // Will send the filesize along with the file as POST data.
      formData.append("_token", csrfToken);
      formData.append("report_id", reportId);
    });

    // let mockFile = { name: "Filename", size: 30000000 };
    // myDropzone.displayExistingFile(mockFile, url+'images/user.png');

    myDropzone.on("addedfile", async(file) => {
      file.previewElement.addEventListener("click", async() => {
        
        try {
          const resp = await fetch(url+'delete/'+ file.url);
          const { message } = await resp.json();
          myDropzone.removeFile(file);
          return await message;

        } catch(error) {
            // Manejo del error
            console.error(error);
            return null;
        }
      });

      // console.log(file.url);
      // console.log(Dropzone.DrozoneFile.dataUrl);
      // console.log("A file has been added");
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

        const formato = image.url.includes('.mp4');
        // const mockFile = { name: 'Borrar', url: image.url};
        let mockFile = {};

        if(formato) {
          mockFile = { name: 'Borrar',  url: image.url };
          myDropzone.displayExistingFile(mockFile, '../images/video.png');
        } else {
          mockFile = { name: 'Borrar', url: image.url};
          myDropzone.displayExistingFile(mockFile, url+'get-image/'+image.url);
        }
        // let mockFile = {};
        // if(formato === -1 ) {
        //   mockFile = { name: "Imagen" };
        // } else {
        //   mockFile = { name: "Video" };
        // }
        // myDropzone.displayExistingFile(mockFile, url+'get-image/'+image.url);
      });
    })

    const state = document.querySelector('#state');
    state.addEventListener('change', async() => {
      municipalities(state.options[state.selectedIndex].value);
    });

    const municipalities = async(stateId) => {

      municipalitySelected = document.querySelector('#municipalityId');
      try {
        const resp = await fetch(url+'municipalities/'+ stateId);
          const {municipalities} = await resp.json();
          
          const selectMunipalities = document.querySelector('#municipality');

          for (let i = selectMunipalities.options.length; i >= 0; i--) {
            selectMunipalities.remove(i);
          }

          const option = document.createElement("option");
          option.text = 'Seleccionar';
          option.value = '';
          selectMunipalities.add(option);

          municipalities.forEach(municipality => {
            const option = document.createElement("option");
            option.text = municipality.name;
            option.value = municipality.id;

            if(municipality.id == municipalitySelected.value ) {
              option.setAttribute('selected', 'selected');
              municipalitySelected.value = '';
            }

            selectMunipalities.add(option);
          });

      } catch(error) {
          // Manejo del error
          console.error(error);
      }
    }

    if( state.options[state.selectedIndex].value !== '') {

      municipalities(state.options[state.selectedIndex].value);
    }

}
