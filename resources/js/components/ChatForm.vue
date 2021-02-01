<template>
    <div>
        <div class="input-group">
            <div>

                <v-btn class="file"  fab dark small>
                    <file-upload
                        post-action="/sendfile"
                        ref='upload'
                        @input-file="$refs.upload.active = true"
                        :headers="{'X-CSRF-TOKEN': token}"
                    >
                        <v-icon >attach_file</v-icon>
                    </file-upload>
                </v-btn>

            </div>
            <div>

                <v-btn @click="toggleEmo" fab dark small color="pink">
                    <v-icon>insert_emoticon</v-icon>
                </v-btn>

            </div>
            <input id="btn-input" type="text" name="message" class="form-control input-sm"
                   placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

            <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
                Send
            </button>
        </span>
        </div>
        <div class="floating-div">
            <picker v-if="emoStatus" set="emojione" @select="onInput" title="Pick your emoji…"/>
        </div>
    </div>
</template>

<script>
import {Picker} from 'emoji-mart-vue'

export default {
    props: ['user'],
    components: {
        Picker
    },

    data() {
        return {
            newMessage: '',
            emoStatus: false,
            token:document.head.querySelector('meta[name="csrf-token"]').content,
        }
    },

    methods: {
        sendMessage() {
            this.$emit('messagesent', {
                user: this.user,
                message: this.newMessage
            });

            this.newMessage = ''
        },
        onInput(e) {
            if (!e) {
                return false;
            }
            if (!this.newMessage) {
                this.newMessage = e.native;
            } else {
                this.newMessage = this.newMessage + e.native;
            }
        },
        toggleEmo() {
            this.emoStatus = !this.emoStatus;
        },
    }
}
</script>
