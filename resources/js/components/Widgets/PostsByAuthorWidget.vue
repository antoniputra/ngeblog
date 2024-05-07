<script setup>
const props = defineProps({});
</script>

<template>
    <div class="stat shadow">
        <div class="stat-figure text-secondary">
            <div class="avatar online">
                <div class="w-16 rounded-full">
                    <img
                        src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg"
                    />
                </div>
            </div>
        </div>
        <div class="stat-value">86%</div>
        <div class="stat-title">Tasks done</div>
        <div class="stat-desc text-secondary">31 tasks remaining</div>
    </div>
</template>
