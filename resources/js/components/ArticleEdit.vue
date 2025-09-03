<script setup>
    import { ref, defineProps } from 'vue'
    import ArticleForm from "./ArticleForm";

    const props = defineProps(['article'])

    const title = ref(props.article.title)
    const articleText = ref(props.article.article_text)
    const selectedCategories = ref(props.article.categories.map(category => category.id))
    const tags = ref(props.article.tags.map(tag => tag.name).join(', '))
    const image = ref('')

    const store = () => {
        let formData = new FormData()

        formData.append('title', title.value)
        formData.append('article_text', articleText.value)
        formData.append('categories', JSON.stringify(selectedCategories.value))
        formData.append('tags', tags.value)

        if (image.value) {
            formData.append('main_image', image.value)
        }

        let uri = '/articles/' + props.article.id

        axios.patch(uri, formData, { headers: { 'Content-Type': 'multipart/form-data' } })
            .then(() => {
                location.href = uri
            })
    }
</script>

