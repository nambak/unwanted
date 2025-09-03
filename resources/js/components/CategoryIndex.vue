<template>
    <Card>
      <CardHeader>
        <CardTitle>카테고리</CardTitle>
      </CardHeader>
      <CardContent>
        <div class="mb-4">
          <Button @click="navigateToCreate" class="w-auto">카테고리 추가</Button>
        </div>
        
        <div v-if="categories.length > 0" class="space-y-2">
          <div 
            v-for="category in categories" 
            :key="category.id"
            class="flex items-center justify-between p-3 border rounded-md bg-background"
          >
            <span>{{ category.name }}</span>
            <Button 
              v-if="isAuthenticated"
              variant="ghost" 
              size="sm" 
              @click="deleteCategory(category.id)"
              class="text-destructive hover:text-destructive hover:bg-destructive/10"
            >
              <Trash2 class="h-4 w-4" />
            </Button>
          </div>
        </div>
        
        <div v-else class="text-center p-4 border rounded-md bg-muted">
          <p class="text-muted-foreground">카테고리가 없습니다.</p>
        </div>
      </CardContent>
    </Card>
</template>

<script setup>
    import { ref, defineProps } from 'vue'
    import {Card, CardContent, CardHeader, CardTitle} from "@/components/ui/card/index.js";
    import { Button } from "@/components/ui/button"
    import { Trash2 } from "lucide-vue-next";

    const props = defineProps({
        categories: {
            type: Array,
            default: () => []
        },
        isAuthenticated: {
            type: Boolean,
            default: false
        }
    })

    const navigateToCreate = () => {
        window.location.href = '/categories/create'
    }

    const deleteCategory = async (categoryId) => {
        try {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            
            const response = await fetch(`/categories/${categoryId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Content-Type': 'application/json'
                }
            })

            if (response.ok) {
                window.location.reload()
            } else {
                console.error('Error deleting category')
            }
        } catch (error) {
            console.error('Error:', error)
        }
    }
</script>

<style scoped>
.categoryDelete { 
    cursor: pointer; 
}
</style>