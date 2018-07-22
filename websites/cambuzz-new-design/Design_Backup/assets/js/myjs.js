  Dropzone.autoDiscover = false;

  $("#buzz-btn").click(function() {
      $('#side-bar-nav').fadeOut();
      $("#top-nav-bar").fadeOut();
      // $("#main-content").fadeOut();
  });

  $(".cd-modal-close").click(function() {
      $("#top-nav-bar").fadeIn();
      $('#side-bar-nav').fadeIn();
      // $("#main-content").fadeIn();

  });

  var nowDate = new Date();
  var today = new Date(nowDate.getFullYear(), nowDate.getMonth(), nowDate.getDate(), 0, 0, 0, 0);

  // Starting Date
  $('#datetimepicker1').datetimepicker({
      format: 'LL'
  });
  // Ending Date
  $('#datetimepicker2').datetimepicker({
      format: 'LL'
  });
  $('#datetimepicker3').datetimepicker({
      format: 'LT'
  });
  $('#datetimepicker4').datetimepicker({
      format: 'LT'
  });


  $('#datetimepicker1').data("DateTimePicker").minDate(today);
  $('#datetimepicker2').data("DateTimePicker").minDate(today);

  $("#datetimepicker1").on("dp.change", function(e) {
      $('#datetimepicker2').data("DateTimePicker").minDate(e.date);
  });
  $("#datetimepicker2").on("dp.change", function(e) {
      $('#datetimepicker1').data("DateTimePicker").maxDate(e.date);
  });


  var myDropzone = new Dropzone("#my", {
      url: "/file/post",
      dictDefaultMessage: "Drop/Click to Upload Poster",
      addRemoveLinks: true,
      removedfile: function(file) {
          var _ref;
          return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
      },
      accept: function(file, done) {
          console.log("uploaded");
          done();
      },
      init: function() {
          this.on("addedfile", function() {
              if (this.files[1] != null) {
                  this.removeFile(this.files[0]);
              }
          });
      }

  });
 