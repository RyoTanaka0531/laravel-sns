<template>
    <div>
        <button
        type="button"
        class="btn btn-success btn-block"
        :class="{'btn btn-light btn-block':this.isJoinedBy}"
        @click="clickJoin"
        >
        <div v-if="this.isJoinedBy === true"><h5>参加済み</h5></div>
        <!-- <div v-else-if="this.countJoins === this.member && this.isJoindedBy === false"><h5>こちらの募集は定員数に達しました。</h5></div> -->
        <div v-else><h5>参加する</h5></div>
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
        initialCountJoins:{
            type: Number,
            default:0,
        },
        member:{
            type:Number
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
            countJoins: this.initialCountJoins,
            member: this.member,
        }
    },
    methods:{
        clickJoin(){
            if (!this.authorized){
                alert('こちらに参加するにはログイン、または新規登録が必要です。')
                return
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