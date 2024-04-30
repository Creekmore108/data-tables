<div x-data="checkAll">
    <input x-ref="checkbox" @change="handleCheck" type="checkbox" class="rounded border-gray-300 shadow">
</div>

@script
<script>
    Alpine.data('checkAll', () => {
        return {
            init() {
                this.$wire.$watch('selectedOrderIds', () => {
                    this.updateCheckAllState()
                })

                this.$wire.$watch('orderIdsOnPage', () => {
                    this.updateCheckAllState()
                })
            },

            updateCheckAllState() {
                if (this.pageIsSelected()) {                // all selected
                    this.$refs.checkbox.checked = true
                    this.$refs.checkbox.indeterminate = false // set to false when not setting to true
                } else if (this.pageIsEmpty()) {            // none are selected
                    this.$refs.checkbox.checked = false
                    this.$refs.checkbox.indeterminate = false // set to false when not setting to true
                } else {
                    this.$refs.checkbox.checked = false     // some are selected
                    this.$refs.checkbox.indeterminate = true
                }
            },

            pageIsSelected() {
                return this.$wire.orderIdsOnPage.every(id => this.$wire.selectedOrderIds.includes(id))
            },

            pageIsEmpty() {
                return this.$wire.selectedOrderIds.length === 0
            },

            handleCheck(e) {
                e.target.checked ? this.selectAll() : this.deselectAll()
            },

            selectAll() {
                this.$wire.orderIdsOnPage.forEach(id => {
                    if (this.$wire.selectedOrderIds.includes(id)) return // if selected on another page

                    this.$wire.selectedOrderIds.push(id) // add checked items from another page
                })
            },

            deselectAll() {
                this.$wire.selectedOrderIds = []
            },
        }
    })
</script>
@endscript
