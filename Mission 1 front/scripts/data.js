function createBarChart(data, chartId, xKey, yKey) {
    const width = 600, height = 300, margin = { top: 20, right: 20, bottom: 40, left: 40 };

    const svg = d3.select(`#${chartId}`)
        .append('svg')
        .attr('width', width)
        .attr('height', height);

    const x = d3.scaleBand()
        .domain(data.map(d => d[xKey]))
        .range([margin.left, width - margin.right])
        .padding(0.1);

    const y = d3.scaleLinear()
        .domain([0, d3.max(data, d => +d[yKey])])
        .range([height - margin.bottom, margin.top]);

    svg.append('g')
        .selectAll('rect')
        .data(data)
        .join('rect')
        .attr('class', 'bar')
        .attr('x', d => x(d[xKey]))
        .attr('y', d => y(d[yKey]))
        .attr('height', d => y(0) - y(d[yKey]))
        .attr('width', x.bandwidth());

    svg.append('g')
        .attr('transform', `translate(0,${height - margin.bottom})`)
        .call(d3.axisBottom(x));

    svg.append('g')
        .attr('transform', `translate(${margin.left},0)`)
        .call(d3.axisLeft(y));
}

function createPieChart(data, chartId, labelKey, valueKey) {
    const width = 400, height = 400, radius = Math.min(width, height) / 2;

    const svg = d3.select(`#${chartId}`)
        .append('svg')
        .attr('width', width)
        .attr('height', height)
        .append('g')
        .attr('transform', `translate(${width / 2},${height / 2})`);

    const pie = d3.pie().value(d => d[valueKey]);
    const arc = d3.arc().innerRadius(0).outerRadius(radius);

    const color = d3.scaleOrdinal()
        .domain(data.map(d => d[labelKey]))
        .range(d3.schemeCategory10);

    svg.selectAll('path')
        .data(pie(data))
        .join('path')
        .attr('d', arc)
        .attr('fill', d => color(d.data[labelKey]));

    svg.selectAll('text')
        .data(pie(data))
        .join('text')
        .attr('transform', d => `translate(${arc.centroid(d)})`)
        .attr('class', 'pie-label')
        .text(d => `${d.data[labelKey]}: ${d.data[valueKey]}`);
}

d3.json('app/dataCollect.php?type=satisfaction').then(data => createBarChart(data, 'satisfaction-chart', 'satisfaction', 'count'));
d3.json('app/dataCollect.php?type=sexe').then(data => createPieChart(data, 'sexe-chart', 'sexe', 'count'));
d3.json('app/dataCollect.php?type=region').then(data => createBarChart(data, 'region-chart', 'nom_region', 'count'));
d3.json('app/dataCollect.php?type=habitat').then(data => createBarChart(data, 'habitat-chart', 'type_habitat', 'count'));
