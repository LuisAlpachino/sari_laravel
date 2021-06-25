window.onload = () => {

    const state = document.querySelector('#state');
    state.addEventListener('change', async() => {
      municipalities(state.options[state.selectedIndex].value);
    });

    const municipalities = async(stateId) => {

      municipalitySelected = document.querySelector('#municipalityId');
      try {
        const resp = await fetch(baseUrl+'/municipalities/'+ stateId);
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
