<template>
    <div>
        <button
        type="button"
        class="btn btn-success btn-block"
        :class="{'btn btn-light btn-block':this.isJoinedBy}"
        >
        <div v-if="this.isJoinedBy === true">参加済み</div>
        <div v-else>参加する</div>
        </button>
    </div>
</template>
<script>
export default {
    props:{
        initialIsJoinedBy:{
            type: Boolean,
            default:false,
        },
    },
    data(){
        return{
            isJoinedBy: this.initialIsJoinedBy,
        }
    },
}
</script>