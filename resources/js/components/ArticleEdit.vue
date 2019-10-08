<script>
    import ArticleForm from "./ArticleForm";

    export default {
        name: "ArticleEdit",

        extends: ArticleForm,

        props: ['article'],

        data() {
            return {
                title: this.article.title,
                articleText: this.article.article_text,
                selectedCategories: this.article.categories.map(category => category.id),
                tags: this.article.tags.map(tag => tag.name)
            }
        },

        store() {
            let formData = new FormData();

            formData.append('title', this.title);
            formData.append('article_text', this.articleText);
            formData.append('categories', JSON.stringify(this.selectedCategories));
            formData.append('tags', this.tags);

            if (this.image) {
                formData.append('main_image', this.image);
            }

            let uri = '/articles/' + this.article.id;

            axios.patch(uri, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
                .then(response => {
                    location.href = uri;
                })
        }
    }
</script>

