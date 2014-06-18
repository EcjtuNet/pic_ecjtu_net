function fileQueueError(file, errorCode, message) {
  try {
    var imageName = "error.gif";
    var errorName = "";
    if (errorCode === SWFUpload.errorCode_QUEUE_LIMIT_EXCEEDED) {
      errorName = "你添加的文件超过了限制！";
    }

    if (errorName !== "") {
      alert(errorName);
      return;
    }

    switch (errorCode) {
      case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
        imageName = "zerobyte.gif";
        break;
      case SWFUpload.QUEUE_ERROR.FILE_EXCEEDS_SIZE_LIMIT:
        imageName = "toobig.gif";
        break;
      case SWFUpload.QUEUE_ERROR.ZERO_BYTE_FILE:
      case SWFUpload.QUEUE_ERROR.INVALID_FILETYPE:
      default:
        alert(message);
        break;
    }

    addImage("http://pic.ecjtu.net/ui/img/" + imageName);

  } catch (ex) {
    this.debug(ex);
  }

}

function fileDialogComplete(numFilesSelected, numFilesQueued) {
  try {
    if (numFilesQueued > 0) {
      this.startUpload();
    }
  } catch (ex) {
    this.debug(ex);
  }
}

function uploadProgress(file, bytesLoaded) {

  try {
    var percent = Math.ceil((bytesLoaded / file.size) * 100);

    var progress = new FileProgress(file,  this.customSettings.upload_target);
    progress.setProgress(percent);
    if (percent === 100) {
      progress.setStatus("生成缩略图...");
      progress.toggleCancel(false, this);
    } else {
      progress.setStatus("正在上传...");
      progress.toggleCancel(true, this);
    }
  } catch (ex) {
    this.debug(ex);
  }
}

function uploadSuccess(file, serverData) {
  try {
    var progress = new FileProgress(file,  this.customSettings.upload_target);

    if (serverData.substring(0, 7) === "FILEID:") {
      addImage("http://pic.ecjtu.net/index.php/admin/picture/thumb/" + serverData.substring(7));

      progress.setStatus("缩略图生成成功！");
      progress.toggleCancel(false);
    } else {
      addImage("http://pic.ecjtu.net/ui/img/error.gif");
      progress.setStatus("错误.");
      progress.toggleCancel(false);
      alert(serverData);

    }


  } catch (ex) {
    this.debug(ex);
  }
}

function uploadComplete(file) {
  try {
    /*  I want the next upload to continue automatically so I'll call startUpload here */
    if (this.getStats().files_queued > 0) {
      this.startUpload();
    } else {
      var progress = new FileProgress(file,  this.customSettings.upload_target);
      progress.setComplete();
      progress.setStatus("所有图片上传完成.");
      progress.toggleCancel(false);
    }
  } catch (ex) {
    this.debug(ex);
  }
}

function uploadError(file, errorCode, message) {
  var imageName =  "error.gif";
  var progress;
  try {
    switch (errorCode) {
      case SWFUpload.UPLOAD_ERROR.FILE_CANCELLED:
        try {
          progress = new FileProgress(file,  this.customSettings.upload_target);
          progress.setCancelled();
          progress.setStatus("Cancelled");
          progress.toggleCancel(false);
        }
        catch (ex1) {
          this.debug(ex1);
        }
        break;
      case SWFUpload.UPLOAD_ERROR.UPLOAD_STOPPED:
        try {
          progress = new FileProgress(file,  this.customSettings.upload_target);
          progress.setCancelled();
          progress.setStatus("Stopped");
          progress.toggleCancel(true);
        }
        catch (ex2) {
          this.debug(ex2);
        }
      case SWFUpload.UPLOAD_ERROR.UPLOAD_LIMIT_EXCEEDED:
        imageName = "uploadlimit.gif";
        break;
      default:
        alert(message);
        break;
    }

    addImage("http://pic.ecjtu.net/ui/img/" + imageName);

  } catch (ex3) {
    this.debug(ex3);
  }

}

var thumbid=0;
function addImage(src) {
  

  var newImgDiv = document.createElement("div");
  newImgDiv.id = 'thumb'+ (thumbid+1);
  document.getElementById("thumbnails").appendChild(newImgDiv);
  newImgDiv.innerHTML = '<img src="'+src+'" />';
  newImgDiv.innerHTML += '<p><input type="hidden" id="pics" name="pictures[]" value="'+(src.substring(src.lastIndexOf('/')+1)).replace(/_/g,'/')+'" /><a href="javascript:delPic('+(thumbid+1)+');">删除</a></p><p style="position:relative;height:20px;"><input type="text" name="descp[]" placeholder="添加评论" />';
  newImgDiv.onload = function () {
    fadeIn(newImgDiv, 0);
  };
  thumbid=thumbid+1;
}
function delPic(id){
  var oldpic=document.getElementById('thumb'+id);
  var myString=oldpic.firstChild.src;
  var p=myString.lastIndexOf('/');
  $.get("http://pic.ecjtu.net/index.php/admin/picture/delpic/" + myString.substr(++p,myString.length-p) + "/" + Math.random());
  document.getElementById("thumbnails").removeChild(oldpic);
}
function fadeIn(element, opacity) {
  var reduceOpacityBy = 5;
  var rate = 30;	// 15 fps


  if (opacity < 100) {
    opacity += reduceOpacityBy;
    if (opacity > 100) {
      opacity = 100;
    }

    if (element.filters) {
      try {
        element.filters.item("DXImageTransform.Microsoft.Alpha").opacity = opacity;
      } catch (e) {
        // If it is not set initially, the browser will throw an error.  This will set it if it is not set yet.
        element.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=' + opacity + ')';
      }
    } else {
      element.style.opacity = opacity / 100;
    }
  }

  if (opacity < 100) {
    setTimeout(function () {
      fadeIn(element, opacity);
    }, rate);
  }
}



/* ******************************************
 *	FileProgress Object
 *	Control object for displaying file info
 * ****************************************** */

function FileProgress(file, targetID) {
  this.fileProgressID = "divFileProgress";

  this.fileProgressWrapper = document.getElementById(this.fileProgressID);
  if (!this.fileProgressWrapper) {
    this.fileProgressWrapper = document.createElement("div");
    this.fileProgressWrapper.className = "progressWrapper";
    this.fileProgressWrapper.id = this.fileProgressID;

    this.fileProgressElement = document.createElement("div");
    this.fileProgressElement.className = "progressContainer";

    var progressCancel = document.createElement("a");
    progressCancel.className = "progressCancel";
    progressCancel.href = "#";
    progressCancel.style.visibility = "hidden";
    progressCancel.appendChild(document.createTextNode(" "));

    var progressText = document.createElement("div");
    progressText.className = "progressName";
    progressText.appendChild(document.createTextNode(file.name));

    var progressBar = document.createElement("div");
    progressBar.className = "progressBarInProgress";

    var progressStatus = document.createElement("div");
    progressStatus.className = "progressBarStatus";
    progressStatus.innerHTML = "&nbsp;";

    this.fileProgressElement.appendChild(progressCancel);
    this.fileProgressElement.appendChild(progressText);
    this.fileProgressElement.appendChild(progressStatus);
    this.fileProgressElement.appendChild(progressBar);

    this.fileProgressWrapper.appendChild(this.fileProgressElement);

    document.getElementById(targetID).appendChild(this.fileProgressWrapper);
    fadeIn(this.fileProgressWrapper, 0);

  } else {
    this.fileProgressElement = this.fileProgressWrapper.firstChild;
    this.fileProgressElement.childNodes[1].firstChild.nodeValue = file.name;
  }

  this.height = this.fileProgressWrapper.offsetHeight;

}
FileProgress.prototype.setProgress = function (percentage) {
  this.fileProgressElement.className = "progressContainer green";
  this.fileProgressElement.childNodes[3].className = "progressBarInProgress";
  this.fileProgressElement.childNodes[3].style.width = percentage + "%";
};
FileProgress.prototype.setComplete = function () {
  this.fileProgressElement.className = "progressContainer blue";
  this.fileProgressElement.childNodes[3].className = "progressBarComplete";
  this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setError = function () {
  this.fileProgressElement.className = "progressContainer red";
  this.fileProgressElement.childNodes[3].className = "progressBarError";
  this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setCancelled = function () {
  this.fileProgressElement.className = "progressContainer";
  this.fileProgressElement.childNodes[3].className = "progressBarError";
  this.fileProgressElement.childNodes[3].style.width = "";

};
FileProgress.prototype.setStatus = function (status) {
  this.fileProgressElement.childNodes[2].innerHTML = status;
};

FileProgress.prototype.toggleCancel = function (show, swfuploadInstance) {
  this.fileProgressElement.childNodes[0].style.visibility = show ? "visible" : "hidden";
  if (swfuploadInstance) {
    var fileID = this.fileProgressID;
    this.fileProgressElement.childNodes[0].onclick = function () {
      swfuploadInstance.cancelUpload(fileID);
      return false;
    };
  }
};
