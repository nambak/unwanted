<template>
    <Card>
      <CardHeader>
        <CardTitle>새 글 쓰기</CardTitle>
      </CardHeader>
      <CardContent>
        <Form>
          <FormField name="title">
            <FormItem>
              <FormLabel>제목</FormLabel>
              <FormControl>
                <Input type="text" v-model="title" class="mb-4"/>
              </FormControl>
              <FormDescription />
              <FormMessage />
            </FormItem>
          </FormField>
          <FormField name="article_text">
            <FormItem>
              <FormLabel>내용</FormLabel>
              <FormControl>
                <Textarea v-model="articleText" class="mb-4"></Textarea>
              </FormControl>
            </FormItem>
          </FormField>
          <FormField name="categories">
            <FormItem>
              <FormLabel>카테고리</FormLabel>
              <FormControl v-if="categories.length > 0">
                <div v-for="category in categories">
                  <Checkbox :id="category.id" :value="category.id" v-model="selectedCategories"/>
                  <Label :for="category.id">{{ category.name }}</Label>
                </div>
              </FormControl>
              <FormControl v-else>
                <Label class="mb-4">등록된 카테고리가 없습니다.</Label>
              </FormControl>
            </FormItem>
          </FormField>
          <FormField name="tags">
            <FormItem>
              <FormLabel>태그</FormLabel>
              <FormControl>
                <Input type="text" v-model="tags" class="mb-4"/>
              </FormControl>
            </FormItem>
          </FormField>
          <FormField name="image">
            <FormItem>
              <FormLabel>이미지</FormLabel>
              <FormControl>
                <Input type="file" class="hidden" @change="handleImageUpload"/>
                <Button type="button" class="w-25">
                  <Upload /> 파일 선택
                </Button>
                <span class="mb-4">{{ imageName ? imageName : '선택된 파일 없음' }}</span>
              </FormControl>
            </FormItem>
          </FormField>
          <Button type="submit" class="w-full" @click="store">저장</Button>
        </Form>
      </CardContent>
    </Card>

</template>
<script setup>
    import { ref, defineProps } from 'vue'
    import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
    import {Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form"
    import { Input } from "@/components/ui/input"
    import { Textarea } from "@/components/ui/textarea"
    import { Checkbox } from "@/components/ui/checkbox"
    import { Label } from "@/components/ui/label"
    import { Button } from "@/components/ui/button"
    import { Upload } from "lucide-vue-next";

    const props = defineProps(['categories'])

    const image = ref('')
    const imageName = ref('')
    const title = ref('')
    const articleText = ref('')
    const selectedCategories = ref([])
    const tags = ref('')

    const handleImageUpload = (event) => {
        image.value = event.target.files[0]
        imageName.value = event.target.files[0].name
    }

    const store = () => {
        let formData = new FormData()

        formData.append('title', title.value)
        formData.append('article_text', articleText.value)
        formData.append('categories', JSON.stringify(selectedCategories.value))
        formData.append('tags', tags.value)
        formData.append('main_image', image.value)

        axios.post('/articles', formData, { headers: {'Content-Type': 'multipart/form-data'}})
            .then(() => {
                location.href = '/articles'
            })
    }
</script>
