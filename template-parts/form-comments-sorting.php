<!-- A radio form for sorting comments -->

<form id="comments-sorting" style="display: flex; justify-content: center; align-items: center; gap: 0.5rem; color: var(--secondary-background)">
    <input type="radio" name="comments-sort" value="oldest" id="oldest" checked>
    <label for="oldest">Oldest</label>

    <input type="radio" name="comments-sort" value="newest" id="newest">
    <label for="newest">Newest</label>

    <input type="radio" name="comments-sort" value="likes" id="likes">
    <label for="likes">Most Liked</label>
</form>
