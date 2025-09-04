<script setup>
import {ref, onMounted} from 'vue'
import axios from 'axios'
import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
import {Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form"
import {Input} from "@/components/ui/input"
import {Button} from "@/components/ui/button"
import { toast } from "vue-sonner"

const name = ref('')

// CSRF 토큰 설정
onMounted(() => {
  const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
  if (token) {
    axios.defaults.headers.common['X-CSRF-TOKEN'] = token
  }
})

const store = async (event) => {
  event.preventDefault() // 기본 폼 제출 방지

  if (!name.value.trim()) {
    toast.error('카테고리 이름을 입력해주세요.')
    return
  }

  try {
    const response = await axios.post('/categories', {name: name.value})
    name.value = '' // 폼 초기화
    
    if (response.data.success) {
      toast.success(response.data.message || '카테고리가 성공적으로 추가되었습니다.')
      // 약간의 지연 후 리다이렉트 (토스트가 보이도록)
      setTimeout(() => {
        window.location.href = '/categories'
      }, 1000)
    }
  } catch (error) {
    console.error('Error:', error)

    if (error.response) {
      // 유효성 검사 오류 처리
      if (error.response.status === 422 && error.response.data.errors) {
        const errors = Object.values(error.response.data.errors).flat()
        errors.forEach(err => toast.error(err))
      } else {
        toast.error(error.response.data.message || '카테고리 추가 중 오류가 발생했습니다.')
      }
    } else if (error.request) {
      toast.error('서버에서 응답이 없습니다.')
    } else {
      toast.error('요청 처리 중 오류가 발생했습니다.')
    }
  }
}
</script>
<template>
  <Card>
    <CardHeader>
      <CardTitle>카테고리 추가</CardTitle>
    </CardHeader>
    <CardContent>
      <Form>
        <FormField name="name">
          <FormItem>
            <FormLabel>카테고리 이름</FormLabel>
            <FormControl>
              <Input type="text" v-model="name" class="mb-4"/>
            </FormControl>
            <FormDescription/>
            <FormMessage/>
          </FormItem>
        </FormField>
        <Button type="submit" class="w-full" @click="store">저장</Button>
      </Form>
    </CardContent>
  </Card>
</template>