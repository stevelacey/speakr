<script type="text/x-jqote-template" class="user-search-result-template">
  <li>
    <a href="/user/<%= this.username %>" title="<%= this.name %>">
      <img src="<%= this.image %>" alt="<%= this.name %> (@<%= this.username %>)"/>
      <em><%= this.name %></em>
      <span>@<%= this.username %></span>
    </a>
    <a href="<%= window.location + '/add/' + this.username %>" class="action add" title="Add as Speaker">Add</a>
  </li>
</script>