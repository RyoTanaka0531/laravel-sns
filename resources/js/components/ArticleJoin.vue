<template>
    <div>
        <button
        type="button"
        class="btn btn-success btn-block"
        :class="{'btn btn-light btn-block':this.isJoinedBy}"
        @click="clickJoin"
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
        authorized:{
            type:Boolean,
            default:false,
        },
        endpoint:{
        type:String,
        },
    },
    data(){
        return{
            isJoinedBy: this.initialIsJoinedBy,
        }
    },
    methods:{
        clickJoin(){
            if (!this.authorized){
                return view('login')
            }

            this.isJoinedBy
            ? this.notJoin()
            :this.join()
        },
        async join(){
            const response = await axios.put(this.endpoint)

            this.isJoinedBy = true
        },
        async notJoin(){
            const response = await axios.delete(this.endpoint)

            this.isJoinedBy = false
        },
    },
}
</script>