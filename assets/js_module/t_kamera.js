/*
filedrag.js - HTML5 File Drag & Drop demonstration
Developed by Craig Buckler (@craigbuckler) of OptimalWorks.net
*/
(function () {
    // getElementById
    function $id(id) {
      return document.getElementById(id);
    }
    // output information
    function Output(msg) {
      var m = $id("messages");
      m.innerHTML = msg + m.innerHTML;
    }
    // file drag hover
    function FileDragHover(e) {
      e.stopPropagation();
      e.preventDefault();
      e.target.className = e.type == "dragover" ? "hover" : "";
      // look at removal of class on icon
    }
    // file selection
    function FileSelectHandler(e) {
      // cancel event and hover styling
      FileDragHover(e);
      // fetch FileList object
      var files = e.target.files || e.dataTransfer.files;
      // process all File objects
      for (var i = 0, f; (f = files[i]); i++) {
        ParseFile(f);
        UploadFile(f);
      }
    }
  
    // output file information
    function ParseFile(file) {
      Output("File name: " + file.name);
  
      // display text
      if (file.type.indexOf("text") == 0) {
        var reader = new FileReader();
        reader.onload = function (e) {
          Output(
            "<p>" +
              file.name +
              ":</p><pre>" +
              e.target.result.replace(/</g, "&lt;").replace(/>/g, "&gt;") +
              "</pre>"
          );
        };
        reader.readAsText(file);
      }
    }
  
    function UploadFile(file) {
      var xhr = new XMLHttpRequest();
      if (
        xhr.upload &&
        (file.type == "text/plain" || file.type == "text/xml") &&
        file.size <= $id("MAX_FILE_SIZE").value
      ) {
        // create progress bar
        //		var o = $id("progress");
        //		var progress = o.appendChild(document.createElement("p"));
        //		progress.appendChild(document.createTextNode("Uploading..."));
        // progress bar
        xhr.upload.addEventListener(
          "progress",
          function (e) {
            //			var pc = parseInt(100 - (e.loaded / e.total * 100));
            //		progress.style.backgroundPosition = pc + "% 0";
          },
          false
        );
        // file received/failed
        xhr.onreadystatechange = function (e) {
          if (xhr.readyState == 4) {
            progress.className = xhr.status == 200 ? "success" : "failure";
          }
          ing;
        };
        // start upload
        xhr.open("POST", $id("upload").action, true);
        xhr.setRequestHeader("X_FILENAME", file.name);
        xhr.send(file);
      }
    }
  
    // initialize
    function Init() {
      var fileselect = $id("fileselect"),
        filedrag = $id("filedrag"),
        submitbutton = $id("submitbutton");
      // file select
      fileselect.addEventListener("change", FileSelectHandler, false);
      // is XHR2 available?
      var xhr = new XMLHttpRequest();
      if (xhr.upload) {
        // file drop
        filedrag.addEventListener("dragover", FileDragHover, false);
        filedrag.addEventListener("dragleave", FileDragHover, false);
        filedrag.addEventListener("drop", FileSelectHandler, false);
        //	filedrag.style.display = "block";
      }
    }
  
    // call initialization file
    if (window.File && window.FileList && window.FileReader) {
      Init();
    }
  })();
  