import './alert';

function share() {

    $('#modal-options').modal('hide');


    let fileId = $('#modal-options-fileId').val();

    const domain = window.location.protocol + "//" + window.location.hostname + (window.location.port ? ':' + window.location.port : '');


    $.ajax({
        url: "/getFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            $('#modal-share-title').html(response.data.title);
            $('#modal-share-btn-link').attr('data-clipboard-text', domain + '/shared/' + response.data.shared_id)
            navigator.clipboard.writeText(domain + '/shared/' + response.data.shared_id)
            $('#modal-share').modal('show');
        },
        error: function() {
            alertError('Có lỗi xảy ra');
        }
    });

      // Gửi yêu cầu Ajax để lấy file
      $.ajax({
        url: "/getRuleFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            $('#onchangeRule').val(response.data.rule);
        },
        error: function() {
            alertError('Có lỗi xảy ra');
        }
    });
}

window.share = share;

function shareFileToMail() {


    let fileId = $('#modal-options-fileId').val();
    let email = $('#modal-share-email').val();

    addLoader()
    $.ajax({
        url: "/shareFileToMail",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId,
            email: email
        },
        success: function(response) {
            if (response.status == 'success') {
                removeLoader()
                alertSuccess('Đã gửi file thành công đến  ' + email);
            } else {
                alertError(response.msg);
            }

        },
        error: function() {
            removeLoader()
            alertError('Có lỗi xảy ra');
        }
    });

}

window.shareFileToMail = shareFileToMail;

// remove file 
function restore(fileId) {

    addLoader()
        // Gửi yêu cầu Ajax để lấy file
    $.ajax({
        url: "/getFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            removeLoader();

            // ajax remove file 
            addLoader()
            $.ajax({
                url: "/restoreFile",
                type: 'POST',
                data: {
                    _token: csrfToken,
                    id: fileId
                },
                success: function(response) {
                    removeLoader();
                    if (response.status == 'success') {
                        alertSuccess('Khôi phục thành công', 2000);
                    }
                },
                error: function() {
                    removeLoader();
                    alertError('Có lỗi xảy ra');
                }
            })
        },
        error: function() {
            removeLoader();
            alertError('Có lỗi xảy ra');
        }
    });

}
window.restore = restore;

// remove file 
function remove(fileId) {

    addLoader()
        // Gửi yêu cầu Ajax để lấy file
    $.ajax({
        url: "/getFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            removeLoader();

            $('#modal-remove-name').html(response.data.title)
            $('#modal-remove').modal('show');

            $('#modal-remove-btn-confirm').click(function() {
                // ajax remove file 
                $.ajax({
                    url: "/removeFile",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        id: fileId
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            alertSuccess('Xoá file thành công', 2000);
                        }
                    },
                    error: function() {
                        alertError('Có lỗi xảy ra');
                    }
                });
            })
        },
        error: function() {
            removeLoader();
            alertError('Có lỗi xảy ra');
        }
    });

}
window.remove = remove;


function removeAllFile(fileId) {

    addLoader()
        // Gửi yêu cầu Ajax để lấy file
    $.ajax({
        url: "/getFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            removeLoader();

            $('#modal-remove-name').html(response.data.title)
            $('#modal-remove').modal('show');

            $('#modal-remove-btn-confirm').click(function() {
                // ajax remove file 
                $.ajax({
                    url: "/removeAllFile",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        id: fileId
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            alertSuccess('Xoá file thành công', 2000);
                        }
                    },
                    error: function() {
                        alertError('Có lỗi xảy ra');
                    }
                });
            })
        },
        error: function() {
            removeLoader();
            alertError('Có lỗi xảy ra');
        }
    });

}
window.removeAllFile = removeAllFile;

// remove file 
function download() {

    $('#modal-options').modal('hide');
    let fileId = $('#modal-options-fileId').val();

    addLoader()
        // Gửi yêu cầu Ajax để lấy file
    $.ajax({
        url: "/getFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            removeLoader();

            window.open("/shared/" + response.data.shared_id, '_blank');

        },
        error: function() {
            removeLoader();
            alertError('Có lỗi xảy ra');
        }
    });

}
window.download = download;



// rename file 
function rename() {

    $('#modal-options').modal('hide');
    let fileId = $('#modal-options-fileId').val();

    addLoader()
    $.ajax({
        url: "/getFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId
        },
        success: function(response) {
            removeLoader();

            $('#modal-rename-title').html(response.data.title)
            $('#modal-rename').modal('show');

            $('#modal-rename-btnSubmit').click(function() {


                let newFileName = $('#modal-rename-newFileName').val();

                // ajax remove file 
                $.ajax({
                    url: "/renameFile",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        newFileName: newFileName,
                        id: fileId
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            alertSuccess('Đổi tên file thành công', 2000);
                        }
                    },
                    error: function() {
                        alertError('Có lỗi xảy ra');
                    }
                });
            })
        },
        error: function() {
            removeLoader();
            alertError('Có lỗi xảy ra');
        }
    });

}
window.rename = rename;


// search file
$('#search').keyup(function(event) {
    let key = $('#search').val();

    event.preventDefault();

    addLoader();
    $.ajax({
        url: "/searchFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            key: key
        },
        success: function(response) {
            let files = response.data.files;
            let folders = response.data.folders;

            let filesHtml = '';

            files.forEach(function(item, index) {
                filesHtml += `
                    <li class="folder-box d-flex align-items-center">
                        <div class="d-flex align-items-center files-list">
                            <div class="flex-shrink-0 file-left">${item.icon}</i>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6>${item.title}</h6>
                                <p>${item.timeAgo}</p>
                            </div>
                        </div>
                    </li>`;
            });

            $('#files').html(filesHtml);




            let folderHtml = '';
            $('#folders').html(folderHtml);

            folders.forEach(function(item, index) {
                folderHtml += `
                     <li class="folder-box">
                        <a href="folder/${item.id}">
                        <div class="d-block"><i class="f-44 fa fa-folder txt-warning"></i><i
                                class="fa fa-ellipsis-v me-0 f-14 ellips"></i>
                            <div class="mt-3">
                                <h6>${item.name}</h6>
                                <p>${item.fileCounts} files<span class="pull-right"> <i class="fa fa-clock-o"> </i> ${ item.timeAgo }</span></p>
                            </div>  
                        </div>
                        </a>
                    </li>  
                    `;
            });

            $('#folders').html(folderHtml);


            removeLoader();
        },
        error: function() {
            alertError('Có lỗi xảy ra');
        }
    });
});

$('#onchangeRule').on('change', function() {
    let value = $('#onchangeRule').val();
    let fileId = $('#modal-options-fileId').val();


   
    
    
    addLoader()
    $.ajax({
        url: "/updateRuleFile",
        type: 'POST',
        data: {
            _token: csrfToken,
            id: fileId,
            value: value
        },
        success: function(response) {
            removeLoader();

            if (response.status == 'success') {
                alertSuccess('Thay đổi quyền thành công', 500);
            }


        },
        error: function() {
            removeLoader();
            alertError('Có lỗi xảy ra');
        }
    });

})