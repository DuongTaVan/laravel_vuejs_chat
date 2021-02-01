<template>
    <ul class="chat">
        <li class="left clearfix" v-for="message in messages">
            <div class="chat-body clearfix">
                <div class="header">
                    <strong class="primary-font">
                        <img class="avatar" src="https://i.pinimg.com/originals/01/48/0f/01480f29ce376005edcbec0b30cf367d.jpg" alt=""> {{ message.user.name }}
                    </strong>
                </div>
                <span v-if="message.message">
                    {{ message.message }}
                </span>
                <div v-if="message.image"  class="image-container">
                    <img class="img" :src="'storage/'+message.image" alt="">
                </div>
                <div class="caption font-italic">
                    {{message.created_at}}
                </div>
            </div>
        </li>
    </ul>
</template>

<script>
export default {
    props: ['messages']
};
</script>
<style>
 ul{
     list-style: none;
 }
 li .clearfix{
     border-radius: 5px;
     padding: 2px;
     margin: 2px;
 }
 li .clearfix span{
     margin-left: 0px;
     padding: 8px 20px;
     background-color: #4f9e4b;
     border-radius: 22px;
     color: white;
 }
 .avatar{
     width: 40px;
     height: 40px;
     border-radius: 50px;
 }
 .header{
     margin: 10px 0;
 }
 .img{
     width: 100px;
     height: 100px;
 }
 .font-italic {
     font-size: 12px;
     margin: 7px 0px 0px 4px;
 }
</style>
