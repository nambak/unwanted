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
              <FormDescription />
              <FormMessage />
            </FormItem>
          </FormField>
          <Button type="submit" class="w-full" @click="store">저장</Button>
        </Form>
      </CardContent>
    </Card>
</template>

<script setup>
    import { ref } from 'vue'
    import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
    import {Form, FormControl, FormDescription, FormField, FormItem, FormLabel, FormMessage} from "@/components/ui/form"
    import { Input } from "@/components/ui/input"
    import { Button } from "@/components/ui/button"

    const name = ref('')

    const store = () => {
        let formData = new FormData()
        formData.append('name', name.value)

        axios.post('/categories', formData)
            .then(() => {
                location.href = '/categories'
            })
            .catch((error) => {
                console.error('Error creating category:', error)
            })
    }
</script>