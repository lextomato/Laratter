<template>
  <div class="border border-primary dropdown-menu input2 width-noti">
    {{ empty() }}
    <p v-for="(notification,i) in notifications">
      <a :href="'/' + notification.data.follower.username" style="text-overflow: ellipsis; overflow: hidden" class="btn btn-outline-primary text-secondary dropdown-item" v-if="!notification.data.privateMessage.conversation_id && i<7">
        <img class="avatar-noti" v-bind:src="notification.data.follower.avatar">  |  <strong>@{{ notification.data.follower.username }}</strong> te ha seguido!
      </a>
      <a :href="'/conversations/' + notification.data.privateMessage.conversation_id" style="text-overflow: ellipsis; overflow: hidden" class="btn btn-outline-primary text-secondary dropdown-item" v-if="notification.data.privateMessage.conversation_id && i<7">
        <img class="avatar-noti" v-bind:src="notification.data.follower.avatar">  |  <strong>{{ notification.data.follower.name }}:</strong> "{{ notification.data.privateMessage.message }}"
      </a>
    </p>
  </div>
</template>

<script>
export default {
  props: ['user'],
  data() {
    return {
      notifications: [],
    }
  },
  mounted() {
    axios.get('/api/notifications')
      .then(response => {
        this.notifications = response.data;
      
        Echo.private(`App.User.${this.user}`)
          .notification(notification => {
            this.notifications.unshift(notification);
          });
      });
  },
  methods: {
    empty: function (notifications) {
            let i = 0
            for(i in this.notifications){ 
              if (!this.notifications[i].data.privateMessage) {
                this.$set(this.notifications[i].data, 'privateMessage', { conversation_id: '', message: '' })
              } 
            }
    }
  }
}
</script>
