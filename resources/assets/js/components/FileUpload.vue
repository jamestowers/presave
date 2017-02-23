<template>
    <div class="file-upload" :class="computedClasses">
        <div 
            v-if="supportsUpload"
            @drag.stop.prevent="" 
            @dragover.stop.prevent="" 
            @dragstart.stop.prevent="onDragStart"
            @dragenter.stop.prevent="onDragStart"
            @dragend.stop.prevent="onDragStop"
            @dragleave.stop.prevent="onDragStop"
            @drop.stop.prevent="onFileDrop"
            >
            <input 
                @change="onFileChange"
                ref="fileInput"
                type="file" 
                :name="name"
                :id="name"
                multiple="multiple" />
            
            <label :for="name">{{ buttonLabel }}</label>

            <div v-if="errors.length" class="file-upload-errors">
                <ul>
                    <li v-for="error in errors">{{ error }}</li>
                </ul>
            </div>

            <div v-if="isUploading" class="progress">
                <div ref="progressBar" class="progress-bar"></div>
            </div>
        </div>

        <div v-else>
            <div class="file-upload-errors">
                Your browser doesn't support file uploads
            </div>
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
                type: String,
                default: 'image/*'
            },
            maxSize: {
                type: Number,
                default: Number.MAX_SAFE_INTEGER
            },
            multiple: {
                type: Boolean,
                default: false
            }
        },

        data(){
            return {
                files: [],
                fileTypes: [],
                isUploading: false,
                buttonLabel: this.label,
                draggingOver: false,
                errors: []
            }
        },

        computed: {
            supportsUpload () {
                if (navigator.userAgent.match(/(Android (1.0|1.1|1.5|1.6|2.0|2.1))|(Windows Phone (OS 7|8.0))|(XBLWP)|(ZuneWP)|(w(eb)?OSBrowser)|(webOS)|(Kindle\/(1.0|2.0|2.5|3.0))/)) {
                    return false
                }
                const el = document.createElement('input')
                el.type = 'file'
                return !el.disabled
            },
            supportsDragAndDrop () {
                const div = document.createElement('div')
                return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && !('ontouchstart' in window || navigator.msMaxTouchPoints)
            },
            computedClasses () {
                return{
                    'dragging-over': this.draggingOver
                }
            }
        },

        mounted() {
            if (this.accept !== 'image/*') {
                this.fileTypes = this.accept.split(',')
                this.fileTypes = this.fileTypes.map(s => s.trim())
            }
        },

        methods: {
            onDragStart () {
                if (!this.supportsDragAndDrop) {
                    return
                }
                this.draggingOver = true
            },
            onDragStop () {
                if (!this.supportsDragAndDrop) {
                    return
                }
                this.draggingOver = false
            },
            onFileDrop (e) {
                this.onDragStop()
                this.onFileChange(e)
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files
                if(files.length === 0){
                    this.buttonLabel = this.label
                    return
                } 

                // Size limit check
                if (files[0].size <= 0 || files[0].size > this.maxSize * 1024 * 1024) {
                    this.errors.push('The file size exceeds the ' + this.maxSize + 'MB limit.')
                    return
                }

                // File type check
                if (this.accept === 'image/*') {
                    if (files[0].type.substr(0, 6) !== 'image/') {
                        this.errors.push('This file type is not supported, images only please')
                        return
                    }
                } else {
                    if (this.fileTypes.indexOf(files[0].type) === -1) {
                        this.errors.push('This file type is not supported.')
                        return
                    }
                }

                if(files.length > 1){
                    this.buttonLabel = files.length + ' files selected'
                }else{
                    this.buttonLabel = files[0].name// || this.$refs.fileInput.value.split('\\').pop()
                }


                this.files = files
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

                this.$http.post(this.action, data, {
                    progress(e) {
                        if (e.lengthComputable) {
                            self.$refs.progressBar.style.width = Math.ceil((e.loaded / e.total) * 100) + '%';
                        }
                    }
                }).then(this.onUploadSuccess, this.onUploadError)

            },

            onUploadSuccess(response){
                //console.log(response.data)
                this.onUploadComplete()
                this.$emit('uploadSuccess', response.data.files)
            },

            onUploadError(response){
                //console.error(error);
                let resp = {
                    error: true,
                    data: {
                        message: response.error
                    }
                }
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
        &.dragging-over{
            background: $grey7;
        }
    }
    .file-upload-errors{
        color: $color-error;
        font-weight: $font-weight-bold;
        ul{
            margin: 0;
        }
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