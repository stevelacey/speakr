<script type="text/x-jqote-template" class="content-search-result-template">
  <li>
    <h3><%= this.title %></h3>
    <div class="two columns">
      <div class="wide column">
        <p><%= this.description %></p>
      </div>
      <% if(this.presentations) { %>
        <div class="actions">
          <a href="<%= window.location + '/' + this.slug %>">Add to Event</a>
        </div>
        <h4>Also presented at:</h4>
        <ul class="presentations thin column">
          <% for(event in this.presentations) { %>
            <li>
              <h5><%= this.presentations[event].name %></h5>
              <p><%= this.presentations[event].date %></p>
              <ul class="users icons">
                <% for(speaker in this.presentations[event].speakers) { %>
                  <li>
                    <a href="/user/<%= this.presentations[event].speakers[speaker].username %>" title="<%= this.presentations[event].speakers[speaker].name %>">
                      <img src="<%= this.presentations[event].speakers[speaker].icon %>" alt="<%= this.presentations[event].speakers[speaker].name %>"/>
                    </a>
                  </li>
                <% } %>
              </ul>
            </li>
          <% } %>
        </ul>
      <% } %>
    </div>
  </li>
</script>