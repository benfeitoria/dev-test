<template>
    <div class="col-md-12 m-4 overflow-auto">
        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item" :class="current <= 1 ? 'disabled' : '' ">
                    <a class="page-link" @click="changeCurrent(1)"> Primeiro</a>
                </li>
                <li class="page-item" :class="current <= 1 ? 'disabled' : '' ">
                    <a class="page-link" @click="changeCurrent(current-1)">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <!--links a esqueda-->
                <li class="page-item" v-for="n in linkLeft" ><a class="page-link" @click="changeCurrent(n)">{{n}}</a></li>

                <!--pagina atual-->
                <li class="page-item active"><a class="page-link" >{{current}}</a></li>

                <!--links a direita-->
                <li class="page-item" v-for="n in linkRight" ><a class="page-link" @click="changeCurrent(n)">{{n}}</a></li>

                <li class="page-item" :class="current == total ? 'disabled' : '' ">
                    <a class="page-link" @click="changeCurrent(current+1)">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
                <li class="page-item" :class="current == total ? 'disabled' : '' ">
                    <a class="page-link" @click="changeCurrent(total)">Ultimo</a>
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        props: {
            current: Number,
            total: Number,
            action: Function,

        },
        data: function () {
            return {
                pages:0,
                maxLinks:2,
                linkLeft:[],
                linkRight:[]
            }
        },
        methods: {
            changeCurrent(current) {
                this.$emit('resetCurrent', current);
                this.action();

            },
            renderLinks:function(){
                let pages = [];
                let i;
                for (i = 1; i <= this.total; i++) {
                    pages.push(i);
                }
                this.pages = pages;

                pages = [];
                for(i= this.current - this.maxLinks; i <= this.current-1; i++){
                    if(i > 0){
                        pages.push(i);
                    }
                }
                this.linkLeft = pages;

                pages = [];
                for(i= this.current + 1; i <= this.current + this.maxLinks;i++){
                    if(i > this.current && i < this.total + 1){
                        pages.push(i);
                    }
                }
                this.linkRight = pages;
            }
        },
        watch: {
            current: function () {
                this.renderLinks();
            },
            total: function () {
                this.renderLinks();
            }
        }
    }
</script>

<style scoped>

</style>
