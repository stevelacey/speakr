<% if(this.users) { %>
  <ul class="users icons">
    <% for(user in this.users) { %>
      <li>
        <a href="/user/<%= this.users[user].username %>" title="<%= this.users[user].name %>">
          <img src="<%= this.users[user].icon %>" alt="<%= this.users[user].name %>"/>
        </a>
      </li>
    <% } %>
  </ul>
<% } %>