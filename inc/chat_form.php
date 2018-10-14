<form class="chat-form" method="POST" action="" enctype="multipart/form-data">
                        <div class="input-group">
                            <input id="send_msg" name="send_msg" type="text" class="form-control input-sm" placeholder="Type your message here..." />
                            <span class="input-group-btn">
                                <button class="btn btn-warning btn-sm"  id="btn-chat">
                                    Send</button>
                            </span>
                        </div>

                        <div class="form-group">
                            <label for="upload-files" id="upload-label"><i class="fas fa-paperclip fa-uploads"></i><i class="fas fa-file-image fa-uploads"></i></label>
                            <input type="file" name="send_file" id="upload-files" class="files-upload">
                            <div class="text-danger"></div>
                        </div>
                    </form>
