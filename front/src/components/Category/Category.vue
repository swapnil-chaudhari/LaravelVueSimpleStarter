<template>
    <tr>
        <td> {{ category.id }} </td>
        <td> {{ category.name }} </td>
        <td> {{ category.description }} </td>
        <td>
            <button class="btn btn-primary" @click.prevent="editCategory(category)">Edit</button>
            <button class="btn btn-danger" @click.prevent="deleteCategory(category)">Delete</button>
        </td>
    </tr>
</template>

<script>
    export default {
        props : ['category'],
        method : {
            editCategory: function(category1){
                alert("Hi")
                //  this.fillCategory.name = category.name;
                //  this.fillCategory.id = category.id;
                //  this.fillCategory.description = category.description;
                //  $("#edit-item").modal('show');
             }
        }
    }
</script>
