<template>
    <form>
        <div class="field">
            <label class="label">제목:</label>
            <div class="control">
                <input type="text" class="input" v-model="title"/>
            </div>
        </div>

        <div class="field">
            <label class="label">내용:</label>
            <div class="control">
                <vue-editor v-model="articleText"></vue-editor>
            </div>
        </div>

        <div class="field">
            <label class="label">카테고리:</label>
            <div class="control">
                <label class="checkbox" v-for="category in categories">
                    <input type="checkbox" :value="category.id" v-model="selectedCategories"/>
                    {{ category.name }}
                </label>
            </div>
        </div>

        <div class="field">
            <label>태그:</label>
            <div class="control">
                <input type="text" class="input" v-model="tags"/>
            </div>
            <p class="help">쉼표로 구분</p>
        </div>

        <div class="field">
            <label for="main_image" class="label">이미지:</label>
            <div class="file has-name">
                <label class="file-label">
                    <input type="file" id="main_image" name="main_image" class="file-input" @change="handleImageUpload">
                    <span class="file-cta">
                        <span class="file-icon">
                            <i class="fas fa-upload"></i>
                        </span>
                        <span class="file-label">
                            파일 선택
                        </span>
                    </span>
                    <span class="file-name">선택된 파일 없음</span>
                </label>
            </div>
        </div>
        <button type="button" class="button is-primary" @click="store">저장</button>
    </form>
</template>
<script>
    import {VueEditor} from "vue2-editor";

    export default {
        name: "ArticleForm",

        components: {
            VueEditor
        },

        props: ['categories'],

        data() {
            return {
                image: '',
                title: '',
                articleText: this.oldArticleText,
                selectedCategories: [],
                tags: '',
            }
        },

        methods: {
            handleImageUpload(event) {
                this.image = event.target.files[0];
            },

            store() {
                let formData = new FormData();

                formData.append('title', this.title);
                formData.append('article_text', this.articleText);
                formData.append('categories', JSON.stringify(this.selectedCategories));
                formData.append('tags', this.tags);
                formData.append('main_image', this.image);

                axios.post('/articles', formData, { headers: {'Content-Type': 'multipart/form-data'}})
                    .then(response => {
                        location.href = '/articles';
                    })
            }
        }
    }
</script>
