  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script>
    let dynamic_field = document.getElementById(`dynamic_field`)
    let add_more = document.getElementById(`add_more`)
    let property = document.getElementById(`property`)
    let value = document.getElementById(`value`)
    let count = 1

    add_more.addEventListener(`click`, (e) => {
      e.preventDefault()
      count++

      let html = `
        <div class="row mt-4" id= autoGenId_`+count+`>
          <div class="col-12 col-sm-8">
            <label class="font-weight-bold" for="">Product Property:</label>
            <input type="text" class="form-control" name="pProperty[]" placeholder="Enter product property name">

            <label class="font-weight-bold" for="">Property Value:</label>
            <input type="text" class="form-control" name="pValue[]" placeholder="Enter Property Value">
          </div>

          <div class="col-12 col-sm-4" style="margin-top: 4rem;">
            <button onclick=remove_attr(`+count+`) class="btn btn-outline-danger">Remove</button>
          </div>
          <input type="hidden" name="arr_id[]" value="">
        </div>
      `
      
      dynamic_field.insertAdjacentHTML("beforeend", html);
    })

    function remove_attr(count) {
      document.getElementById(`autoGenId_`+count).remove()
    }
  </script>
  </body>
</html>