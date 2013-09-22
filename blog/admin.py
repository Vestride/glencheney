from django.contrib import admin
from blog.models import Post

class PostAdmin(admin.ModelAdmin):
  # fields display on change list
  list_display = ['title', 'description']

  # fields to filter the change list with
  list_filter = ['published', 'created']

  # fields to search in change list
  search_fields = ['title', 'description', 'content']

  # enable the date drill down on change list
  date_heirarchy = 'created'

  # enables the save buttons at the top of the form
  save_on_top = True

  # prepopulate slug from the title
  prepopulated_fields = { "slug": ("title", ) }


admin.site.register(Post, PostAdmin)

