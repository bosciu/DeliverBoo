<template>
    <div class="cork">
        <div v-for="restaurant in restaurants" :key="restaurant.id" class="post-it">
            <div class="content">
                <div class="img-container">
                    <img :src="'/storage/'+ restaurant.img_path" alt="">
                </div>
                <div class="text">
                    <p class="mt-3">{{restaurant.name}}</p>
                </div>
            </div> 
        </div>
    </div>  
</template>

<script>
export default {
    name: "MainCards",
    data:function(){
        return {
            restaurants:[]
        }
    },
    created:function(){
        this.getRestaurants(); 
    },
    methods: {
        getRestaurants: function() {
            axios
                .get('http://127.0.0.1:8000/api/restaurants')
                .then(
                    res=> {
                        this.restaurants = res.data
                    }  
                )
                .catch(
                    err=>{
                        console.log(err);
                    }
                );
        }
    }
}

</script>

<style lang="scss" scoped>
@import "./resources/sass/_variables";

    .cork {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: center;
        padding: 30px;
        background-image: url('/images/cork-bg.jpg');
        
        .post-it {
            position: relative;
            display: flex;
            width: calc(100% / 4);
            height: 300px;
            background-image: url('/images/post-it.png');
            background-size: contain;
            background-repeat: no-repeat;

            .content {
                position: absolute;
                top: 15%;
                left: 15%;
                transform: rotate(-11deg);

                .img-container {
                width: 50%;
                height: 50%;

                    img {
                        width: 100%;
                        object-fit: cover;
                        border-radius: 10px;
                        box-shadow: 2px 2px rgba(0, 0, 0, 0.3);
                    }
                }
        
                .text {
                    p {
                        font-size: 20px;
                        font-weight: bolder;
                        text-transform: uppercase;
                        color: #2D3232;
                    }
                }
            }

                
            
        }
        
    }
</style>