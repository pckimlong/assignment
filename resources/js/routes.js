import JobComponent from "./components/JobComponent.vue";
import Organization from "./pages/Organization.vue";
import JobCategory from "./pages/JobCategory.vue";
import JobTitle from "./pages/JobTitle.vue";

const routes = [
    {
        path: "/",
        component: JobComponent
    },
    {
        path: "/jobs-by-organization",
        component: Organization
    },
    {
        path: "/jobs-by-title",
        component: JobTitle
    },
    {
        path: "/jobs-by-category",
        component: JobCategory
    }
];
export default routes;
