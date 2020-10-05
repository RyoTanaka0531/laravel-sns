<!-- <template>
    <div>
        <div class="mt-3">
            <img class="rounded-circle d-block mx-auto" width="100" height="100" id="thumbnail" :src="uploadedImage" v-show="uploadedImage">
        </div>
        <label for="thumbnail">プロフィール画像</label>
        <input type="file" name="thumbnail" id="thumbnail" @change="onFileChange" class="d-block mx-auto">
    </div>
</template>
<script>
export default {
    props:{
        initialUploadedImage:{
            type: String,
        },
    },
    data() {
        return {
            uploadedImage: this.initialUploadedImage,
        };
    },
    methods: {
        onFileChange(e) {
            let files = e.target.files;
            this.createImage(files[0]); //File情報格納
        },
        //アップロードした画像を表示
        createImage(file) {
            let reader = new FileReader(); //File API生成
            reader.onload = (e) => {
                this.uploadedImage = e.target.result;
            };

            reader.readAsDataURL(file);
        },
    },
}
</script>