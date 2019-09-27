<template>
    <div class="info-block pb-20">
        <p v-if="! finished">
            <slot></slot>
        </p>
        <div v-else>
            <article class="message icon-msg success-msg">
                <i class="sl sl-icon-check"></i>
                <div class="message-body">
                    <h4><strong>You have finished this section.</strong></h4>
                    <p>Feel free to edit and update by clicking cancel button.</p>
                </div>
            </article>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['finished'],
    }
</script>
