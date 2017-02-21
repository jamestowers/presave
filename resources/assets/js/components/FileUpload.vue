<template>
    <div class="file-upload">

        <input 
            @change="onFileChange"
            ref="fileInput"
            type="file" 
            :name="name"
            :id="name"
            multiple="multiple" />
        
        <label :for="name">{{ buttonLabel }}</label>

        <div class="progress">
            <div ref="progressBar" class="progress-bar"></div>
        </div>

    </div>
</template>

<script>

    export default {

        props: {
            label: {
                type: String,
                default: 'Choose file'
            },
            name: {
                type: String,
                default: 'file'
            },
            action: {
                type: String,
                required: true
            },
            accept: {
                type: String
            },
            multiple: {
                type: Boolean,
                default: false
            }
        },

        data(){
            return {
                files: [],
                isUploading: false,
                buttonLabel: this.label
            }
        },

        computed: {
            //
        },

        methods: {
            onFileChange(el) {
                this.files = el.target.files
                if(this.files.length === 0){
                    this.buttonLabel = this.label
                } else {
                    if(this.files.length > 1){
                        this.buttonLabel = this.files.length + ' files selected'
                    }else{
                        this.buttonLabel = this.$refs.fileInput.value.split('\\').pop()
                    }
                }
                this.uploadFile()
            },

            uploadFile(){
                this.isUploading = true
                let self = this
                let data = new FormData();
                // TODO loop through this.files and add each fiel to data
                data.append('file', this.files[0]);
                /*for(let file in this.files){
                    data.append('files', file);
                }*/

                var request = new XMLHttpRequest();

                request.onreadystatechange = function(){
                    if(request.readyState == 4){
                        try {
                            var resp = JSON.parse(request.response);
                            self.onUploadSuccess(resp.files)
                        } catch (e){
                            var resp = {
                                status: 'error',
                                data: 'Unknown error occurred: [' + request.responseText + ']'
                            };
                            self.onUploadError(resp)
                        }
                    }
                };

                request.upload.addEventListener('progress', function(e){
                    self.$refs.progressBar.style.width = Math.ceil(e.loaded/e.total) * 100 + '%';
                }, false);

                request.open('POST', this.action);
                request.send(data);

            },

            onUploadSuccess(files){
                //console.log($files)
                this.onUploadComplete()
                this.$emit('uploadSuccess', files)
            },

            onUploadError(resp){
                //console.error(resp.status + ': ' + resp.data);
                this.onUploadComplete()
                this.$emit('uploadError', resp)
            },

            onUploadComplete(){
                this.isUploading = false
                this.$emit('uploadComplete')
            }
        }
    }

</script>

<style lang="scss">
    
    @import "../../sass/variables.scss";
    
    .file-upload{
        padding-bottom: $padding;
    }
    input[type="file"]{
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
        -webkit-appearance: none;
    }
    input[type="file"] + label {
        background-color: $color-primary;
        border-radius: 20px;
        font-size: 1.2rem;
        text-transform: uppercase;
        padding: 8px 20px;
        display: inline-block;
        cursor: pointer;
        &:before{
          font-size: 1em;
          vertical-align: middle;
        }
    }
    input[type="file"]:focus + label,
    input[type="file"] + label:hover {
        background-color: lighten($color-primary, 7);
        transition: transform 0.1s ease-in;
        transform: scale(1.05);
    }
    input[type="file"]:focus + label {
      outline: 1px dotted #000;
      outline: -webkit-focus-ring-color auto 5px;
      * {
        pointer-events: none;
      }
    }
    .progress {
        background: $grey7;
        border-radius: 20px;
        overflow: hidden;
        height: 4px;  
        position: relative;
    }
    .progress-bar {
        width: 0%;
        background: $color-primary;
        height: 100%;
        position: absolute;
        transition: width 0.4s ease-in-out;
        top:0;
        left:0;  
    }

</style>