<script type="text/x-jqote-template" class="content-search-result-template">
  <li>
    <div class="two columns">
      <div class="wide column">
        <h3><%= this.title %></h3>
        <ul class="users icons">
          <% for(speaker in this.speakers) { %>
            <li>
              <a href="/user/<%= this.speakers[speaker].username %>" title="<%= this.speakers[speaker].name %>">
                <img src="<%= this.speakers[speaker].icon %>" alt="<%= this.speakers[speaker].name %>"/>
              </a>
            </li>
          <% } %>
        </ul>
      </div>
      <div class="actions">
        <a href="<%= window.location + '/' + this.slug %>">Add to Event</a>
      </div>
    </div>
  </li>
</script>